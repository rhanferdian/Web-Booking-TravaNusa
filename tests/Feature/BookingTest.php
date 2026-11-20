<?php

use App\Models\Booking;
use App\Models\Tour;

test('public user can view published tour detail page', function () {
    $tour = Tour::create([
        'title' => 'Paket Wisata Bromo Sunrise',
        'slug' => 'paket-wisata-bromo-sunrise',
        'location' => 'Bromo, Jawa Timur',
        'price' => 750000,
        'duration' => '2D1N',
        'thumbnail' => 'tours/bromo.jpg',
        'description' => 'Eksplorasi keindahan matahari terbit Bromo.',
        'is_published' => true,
    ]);

    $response = $this->get(route('tours.detail', $tour));

    $response->assertOk();
    $response->assertSee('Paket Wisata Bromo Sunrise');
    $response->assertSee('Rp 750.000');
    $response->assertSee('Formulir Pemesanan');
});

test('public user cannot view unpublished tour detail page', function () {
    $tour = Tour::create([
        'title' => 'Paket Private Draft',
        'slug' => 'paket-private-draft',
        'location' => 'Raja Ampat',
        'price' => 5000000,
        'duration' => '4D3N',
        'thumbnail' => 'tours/draft.jpg',
        'is_published' => false,
    ]);

    $response = $this->get(route('tours.detail', $tour));

    $response->assertNotFound();
});

test('public user can submit booking form and total_amount is calculated correctly', function () {
    $tour = Tour::create([
        'title' => 'Paket Wisata Labuan Bajo',
        'slug' => 'paket-wisata-labuan-bajo',
        'location' => 'Labuan Bajo, NTT',
        'price' => 1500000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/bajo.jpg',
        'is_published' => true,
    ]);

    $payload = [
        'tour_id' => $tour->id,
        'customer_name' => 'Budi Santoso',
        'customer_phone' => '081234567890',
        'travel_date' => now()->addDays(7)->format('Y-m-d'),
        'total_pax' => 4,
    ];

    $response = $this->post(route('booking.store'), $payload);

    // Rumus: total_amount = tour.price * total_pax -> 1.500.000 * 4 = 6.000.000
    $expectedTotal = 1500000 * 4;

    $this->assertDatabaseHas('bookings', [
        'tour_id' => $tour->id,
        'customer_name' => 'Budi Santoso',
        'customer_phone' => '081234567890',
        'total_pax' => 4,
        'total_amount' => $expectedTotal,
        'status' => 'pending',
    ]);

    $booking = Booking::where('customer_name', 'Budi Santoso')->first();

    expect($booking)->not->toBeNull();
    expect($booking->booking_code)->toStartWith('TRV-');
    expect($booking->total_amount)->toBe($expectedTotal);

    $response->assertRedirect(route('booking.success', $booking->booking_code));
});

test('booking validation fails when required fields are missing', function () {
    $response = $this->post(route('booking.store'), []);

    $response->assertSessionHasErrors([
        'tour_id',
        'customer_name',
        'customer_phone',
        'travel_date',
        'total_pax',
    ]);
});

test('booking validation fails when travel_date is in the past', function () {
    $tour = Tour::create([
        'title' => 'Paket Wisata Bali',
        'slug' => 'paket-wisata-bali',
        'location' => 'Bali',
        'price' => 1000000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/bali.jpg',
        'is_published' => true,
    ]);

    $response = $this->post(route('booking.store'), [
        'tour_id' => $tour->id,
        'customer_name' => 'Budi',
        'customer_phone' => '081234567890',
        'travel_date' => now()->subDay()->format('Y-m-d'),
        'total_pax' => 2,
    ]);

    $response->assertSessionHasErrors(['travel_date']);
});

test('booking success page displays booking details and tour info', function () {
    $tour = Tour::create([
        'title' => 'Paket Wisata Derawan',
        'slug' => 'paket-wisata-derawan',
        'location' => 'Derawan, Kaltim',
        'price' => 2000000,
        'duration' => '4D3N',
        'thumbnail' => 'tours/derawan.jpg',
        'is_published' => true,
    ]);

    $booking = Booking::create([
        'tour_id' => $tour->id,
        'booking_code' => 'TRV-261118-TEST1',
        'customer_name' => 'Siti Rahma',
        'customer_phone' => '08987654321',
        'travel_date' => now()->addDays(14)->format('Y-m-d'),
        'total_pax' => 2,
        'total_amount' => 4000000,
        'status' => 'pending',
    ]);

    $response = $this->get(route('booking.success', $booking->booking_code));

    $response->assertOk();
    $response->assertSee('TRV-261118-TEST1');
    $response->assertSee('Siti Rahma');
    $response->assertSee('Paket Wisata Derawan');
    $response->assertSee('Rp 4.000.000');
});

test('unauthenticated users cannot access booking admin routes', function () {
    $this->get(route('bookings.index'))->assertRedirect(route('login'));
    $this->get(route('bookings.create'))->assertRedirect(route('login'));
    $this->post(route('bookings.store'), [])->assertRedirect(route('login'));
});

test('authenticated user can view bookings index page', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('bookings.index'));

    $response->assertOk();
    $response->assertSee('Kelola Booking');
});

test('authenticated user can view create booking form', function () {
    $user = \App\Models\User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('bookings.create'));

    $response->assertOk();
    $response->assertSee('Tambah Booking Manual');
});

test('authenticated user can store new booking from admin', function () {
    $user = \App\Models\User::factory()->create();
    $tour = Tour::create([
        'title' => 'Paket Wisata Karimunjawa',
        'slug' => 'paket-wisata-karimunjawa',
        'location' => 'Jepara',
        'price' => 1200000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/karimun.jpg',
        'is_published' => true,
    ]);

    $response = $this
        ->actingAs($user)
        ->post(route('bookings.store'), [
            'tour_id' => $tour->id,
            'customer_name' => 'Ahmad Dani',
            'customer_phone' => '085512345678',
            'travel_date' => now()->addDays(10)->format('Y-m-d'),
            'total_pax' => 3,
            'status' => 'confirmed',
        ]);

    $response->assertRedirect(route('bookings.index'));
    $this->assertDatabaseHas('bookings', [
        'customer_name' => 'Ahmad Dani',
        'total_amount' => 1200000 * 3,
        'status' => 'confirmed',
    ]);
});

test('authenticated user can update booking', function () {
    $user = \App\Models\User::factory()->create();
    $tour = Tour::create([
        'title' => 'Paket Wisata Belitung',
        'slug' => 'paket-wisata-belitung',
        'location' => 'Belitung',
        'price' => 1800000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/belitung.jpg',
        'is_published' => true,
    ]);

    $booking = Booking::create([
        'tour_id' => $tour->id,
        'booking_code' => 'TRV-261119-UPDATE',
        'customer_name' => 'Rina',
        'customer_phone' => '081299998888',
        'travel_date' => now()->addDays(5)->format('Y-m-d'),
        'total_pax' => 2,
        'total_amount' => 3600000,
        'status' => 'pending',
    ]);

    $response = $this
        ->actingAs($user)
        ->put(route('bookings.update', $booking), [
            'tour_id' => $tour->id,
            'customer_name' => 'Rina Wijaya',
            'customer_phone' => '081299998888',
            'travel_date' => now()->addDays(7)->format('Y-m-d'),
            'total_pax' => 4,
            'status' => 'confirmed',
        ]);

    $response->assertRedirect(route('bookings.index'));
    $this->assertDatabaseHas('bookings', [
        'id' => $booking->id,
        'customer_name' => 'Rina Wijaya',
        'total_pax' => 4,
        'total_amount' => 1800000 * 4,
        'status' => 'confirmed',
    ]);
});

test('authenticated user can delete booking', function () {
    $user = \App\Models\User::factory()->create();
    $tour = Tour::create([
        'title' => 'Paket Wisata Malang',
        'slug' => 'paket-wisata-malang',
        'location' => 'Malang',
        'price' => 600000,
        'duration' => '2D1N',
        'thumbnail' => 'tours/malang.jpg',
        'is_published' => true,
    ]);

    $booking = Booking::create([
        'tour_id' => $tour->id,
        'booking_code' => 'TRV-261119-DEL01',
        'customer_name' => 'Hendra',
        'customer_phone' => '081211112222',
        'travel_date' => now()->addDays(3)->format('Y-m-d'),
        'total_pax' => 1,
        'total_amount' => 600000,
        'status' => 'canceled',
    ]);

    $response = $this
        ->actingAs($user)
        ->delete(route('bookings.destroy', $booking));

    $response->assertRedirect(route('bookings.index'));
    $this->assertDatabaseMissing('bookings', [
        'id' => $booking->id,
    ]);
});
