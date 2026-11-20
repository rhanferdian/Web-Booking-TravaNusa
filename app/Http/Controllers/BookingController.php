<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Display a listing of bookings for admin.
     */
    public function index(Request $request): View
    {
        $query = Booking::query()->with('tour')->latest();

        if ($request->filled('search')) {
            $search = (string) $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('booking_code', 'like', "%{$search}%")
                    ->orWhere('customer_name', 'like', "%{$search}%")
                    ->orWhere('customer_phone', 'like', "%{$search}%")
                    ->orWhereHas('tour', function ($tourQuery) use ($search) {
                        $tourQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('tour_id')) {
            $query->where('tour_id', $request->input('tour_id'));
        }

        $bookings = $query->paginate(10)->withQueryString();
        $tours = Tour::orderBy('title')->get();

        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'canceled' => Booking::where('status', 'canceled')->count(),
        ];

        return view('bookings.index', compact('bookings', 'tours', 'stats'));
    }

    /**
     * Show the form for creating a new booking (admin).
     */
    public function create(): View
    {
        $tours = Tour::where('is_published', true)->orderBy('title')->get();

        return view('bookings.create', compact('tours'));
    }

    /**
     * Store a newly created booking from admin.
     */
    public function store(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $tour = Tour::findOrFail($validated['tour_id']);

        $totalAmount = $tour->price * (int) $validated['total_pax'];

        Booking::create([
            'tour_id' => $tour->id,
            'booking_code' => $this->generateBookingCode(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'travel_date' => $validated['travel_date'],
            'total_pax' => $validated['total_pax'],
            'total_amount' => $totalAmount,
            'status' => $validated['status'] ?? 'pending',
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking berhasil ditambahkan.');
    }

    /**
     * Store a new booking from the public detail page.
     */
    public function storePublic(StoreBookingRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $tour = Tour::findOrFail($validated['tour_id']);

        abort_if(! $tour->is_published, 404);

        $totalAmount = $tour->price * (int) $validated['total_pax'];

        $booking = Booking::create([
            'tour_id' => $tour->id,
            'booking_code' => $this->generateBookingCode(),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'travel_date' => $validated['travel_date'],
            'total_pax' => $validated['total_pax'],
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('booking.success', $booking->booking_code)
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    /**
     * Display the specified booking detail (admin).
     */
    public function show(Booking $booking): View
    {
        $booking->load('tour');

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show the form for editing the specified booking (admin).
     */
    public function edit(Booking $booking): View
    {
        $booking->load('tour');
        $tours = Tour::orderBy('title')->get();

        return view('bookings.edit', compact('booking', 'tours'));
    }

    /**
     * Update the specified booking in storage (admin).
     */
    public function update(UpdateBookingRequest $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validated();
        $tour = Tour::findOrFail($validated['tour_id']);

        $totalAmount = $tour->price * (int) $validated['total_pax'];

        $booking->update([
            'tour_id' => $tour->id,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'travel_date' => $validated['travel_date'],
            'total_pax' => $validated['total_pax'],
            'total_amount' => $totalAmount,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking #' . $booking->booking_code . ' berhasil diperbarui.');
    }

    /**
     * Remove the specified booking from storage (admin).
     */
    public function destroy(Booking $booking): RedirectResponse
    {
        $code = $booking->booking_code;
        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking #' . $code . ' berhasil dihapus.');
    }

    /**
     * Display the public booking success confirmation page.
     */
    public function success(string $bookingCode): View
    {
        $booking = Booking::with('tour')
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return view('booking-success', compact('booking'));
    }

    /**
     * Alias for success method.
     */
    public function succes(string $bookingCode): View
    {
        return $this->success($bookingCode);
    }

    /**
     * Generate a unique booking code with format: TRV-YYMMDD-XXXXX.
     */
    private function generateBookingCode(): string
    {
        do {
            $code = 'TRV-' . now()->format('ymd') . '-' . strtoupper(Str::random(5));
        } while (Booking::where('booking_code', $code)->exists());

        return $code;
    }
}
