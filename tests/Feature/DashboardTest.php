<?php

use App\Models\Booking;
use App\Models\Tour;
use App\Models\User;

test('unauthenticated users cannot access dashboard', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('authenticated user can view dashboard with statistics', function () {
    $user = User::factory()->create();

    $tour = Tour::create([
        'title' => 'Tour Raja Ampat Eksotis',
        'slug' => 'tour-raja-ampat-eksotis',
        'location' => 'Papua Barat',
        'price' => 5000000,
        'duration' => '4D3N',
        'thumbnail' => 'tours/rajaampat.jpg',
        'is_published' => true,
    ]);

    Booking::create([
        'tour_id' => $tour->id,
        'booking_code' => 'TRV-261119-DASH1',
        'customer_name' => 'Fajar',
        'customer_phone' => '081234567890',
        'travel_date' => now()->addDays(5)->format('Y-m-d'),
        'total_pax' => 2,
        'total_amount' => 10000000,
        'status' => 'confirmed',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('dashboard'));

    $response->assertOk();
    $response->assertSee('Dashboard');
    $response->assertSee('Total Paket Tour');
    $response->assertSee('Total Booking');
    $response->assertSee('Booking Pending');
    $response->assertSee('Total Pendapatan');
    $response->assertSee('TRV-261119-DASH1');
    $response->assertSee('Tour Raja Ampat Eksotis');
});
