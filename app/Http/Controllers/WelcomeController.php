<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the landing page with available tours.
     */
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $query = Tour::query()
            ->where('is_published', true)
            ->latest();

        if ($request->filled('search')) {
            $query->where(function ($builder) use ($search) {
                $builder->where('title', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $tours = $query->get();

        return view('welcome', compact('tours', 'search'));
    }

    /**
     * Display the public detail page for a single published tour.
     */
    public function show(Tour $tour): View
    {
        abort_if(! $tour->is_published, 404);

        return view('detail', compact('tour'));
    }
}
