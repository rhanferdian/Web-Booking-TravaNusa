<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with statistics and recent data.
     */
    public function index(): View
    {
        $totalBooking = Booking::count();
        $totalTour = Tour::count();
        $totalBookingPending = Booking::where('status', 'pending')->count();
        $totalBookingConfirmed = Booking::where('status', 'confirmed')->count();
        $totalBookingCanceled = Booking::where('status', 'canceled')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_amount');

        $recentBookings = Booking::with('tour')->latest()->take(5)->get();
        $latestTours = Tour::latest()->take(4)->get();

        return view('dashboard', compact(
            'totalBooking',
            'totalTour',
            'totalBookingPending',
            'totalBookingConfirmed',
            'totalBookingCanceled',
            'totalRevenue',
            'recentBookings',
            'latestTours'
        ));
    }
}
