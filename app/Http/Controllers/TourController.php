<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTourRequest;
use App\Http\Requests\UpdateTourRequest;
use App\Models\Tour;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $query = Tour::query()->latest();

        if ($request->filled('search')) {
            $search = (string) $request->input('search');
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $status = $request->input('status');
            if ($status === 'published') {
                $query->where('is_published', true);
            } elseif ($status === 'draft') {
                $query->where('is_published', false);
            } elseif ($status === 'popular') {
                $query->where('is_popular', true);
            }
        }

        $tours = $query->paginate(10)->withQueryString();

        return view('tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('tours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title']);
        }

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')->store('tours', 'public');
        }

        Tour::create($validated);

        return redirect()->route('tours.index')->with('success', 'Paket Tour berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour): View
    {
        return view('tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour): View
    {
        return view('tours.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour): RedirectResponse
    {
        $validated = $request->validated();

        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateUniqueSlug($validated['title'], $tour->id);
        }

        if ($request->hasFile('thumbnail')) {
            if ($tour->thumbnail && !Str::startsWith($tour->thumbnail, ['http://', 'https://'])) {
                Storage::disk('public')->delete($tour->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('tours', 'public');
        }

        $tour->update($validated);

        return redirect()->route('tours.index')->with('success', 'Data tour berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour): RedirectResponse
    {
        $bookingsCount = $tour->bookings()->count();

        if ($bookingsCount > 0) {
            return redirect()
                ->route('tours.index')
                ->with('error', "Paket wisata \"{$tour->title}\" tidak dapat dihapus karena masih digunakan pada {$bookingsCount} data booking.");
        }

        if ($tour->thumbnail && !Str::startsWith($tour->thumbnail, ['http://', 'https://'])) {
            Storage::disk('public')->delete($tour->thumbnail);
        }

        $tour->delete();

        return redirect()->route('tours.index')->with('success', 'Tour berhasil dihapus.');
    }

    /**
     * Generate a unique slug for the tour.
     */
    protected function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        $slug = $baseSlug;
        $counter = 1;

        while (Tour::query()
            ->where('slug', $slug)
            ->when($ignoreId !== null, fn ($query) => $query->where('id', '!=', $ignoreId))
            ->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
