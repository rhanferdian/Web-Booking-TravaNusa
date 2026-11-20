<?php

use App\Models\Tour;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('unauthenticated users cannot access tour routes', function () {
    $this->get(route('tours.index'))->assertRedirect(route('login'));
    $this->get(route('tours.create'))->assertRedirect(route('login'));
    $this->post(route('tours.store'), [])->assertRedirect(route('login'));
});

test('authenticated user can view tour index page', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('tours.index'));

    $response->assertOk();
    $response->assertSee('Kelola Tours');
});

test('authenticated user can view create tour form', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('tours.create'));

    $response->assertOk();
    $response->assertSee('Tambah Tour Baru');
});

test('authenticated user can create a new tour with image upload', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $thumbnail = UploadedFile::fake()->image('bali-tour.jpg', 600, 400);

    $response = $this
        ->actingAs($user)
        ->post(route('tours.store'), [
            'title' => 'Paket Liburan Bali Eksotis',
            'location' => 'Bali, Indonesia',
            'price' => 2500000,
            'duration' => '3 Hari 2 Malam',
            'thumbnail' => $thumbnail,
            'is_published' => '1',
            'is_popular' => '1',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('tours.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseHas('tours', [
        'title' => 'Paket Liburan Bali Eksotis',
        'slug' => 'paket-liburan-bali-eksotis',
        'location' => 'Bali, Indonesia',
        'price' => 2500000,
        'duration' => '3 Hari 2 Malam',
        'is_published' => true,
        'is_popular' => true,
    ]);

    $tour = Tour::first();
    Storage::disk('public')->assertExists($tour->thumbnail);
});

test('authenticated user can view tour show page', function () {
    $user = User::factory()->create();
    $tour = Tour::create([
        'title' => 'Tour Raja Ampat',
        'slug' => 'tour-raja-ampat',
        'location' => 'Papua Barat',
        'price' => 5000000,
        'duration' => '4D3N',
        'thumbnail' => 'tours/sample.jpg',
        'is_published' => true,
        'is_popular' => true,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('tours.show', $tour));

    $response->assertOk();
    $response->assertSee('Tour Raja Ampat');
    $response->assertSee('Papua Barat');
    $response->assertSee('Rp 5.000.000');
});

test('authenticated user can view edit tour form', function () {
    $user = User::factory()->create();
    $tour = Tour::create([
        'title' => 'Tour Danau Toba',
        'slug' => 'tour-danau-toba',
        'location' => 'Sumatera Utara',
        'price' => 1800000,
        'duration' => '2D1N',
        'thumbnail' => 'tours/toba.jpg',
        'is_published' => true,
        'is_popular' => false,
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('tours.edit', $tour));

    $response->assertOk();
    $response->assertSee('Tour Danau Toba');
});

test('authenticated user can update an existing tour', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $tour = Tour::create([
        'title' => 'Tour Labuan Bajo Lama',
        'slug' => 'tour-labuan-bajo-lama',
        'location' => 'Labuan Bajo, NTT',
        'price' => 3000000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/old.jpg',
        'is_published' => false,
        'is_popular' => false,
    ]);

    $newThumbnail = UploadedFile::fake()->image('new-bajo.jpg');

    $response = $this
        ->actingAs($user)
        ->put(route('tours.update', $tour), [
            'title' => 'Tour Labuan Bajo Premium',
            'location' => 'Labuan Bajo, NTT',
            'price' => 4500000,
            'duration' => '4D3N',
            'thumbnail' => $newThumbnail,
            'is_published' => '1',
            'is_popular' => '1',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('tours.index'))
        ->assertSessionHas('success');

    $tour->refresh();

    expect($tour->title)->toBe('Tour Labuan Bajo Premium');
    expect($tour->price)->toBe(4500000);
    expect($tour->is_published)->toBeTrue();
    expect($tour->is_popular)->toBeTrue();
    Storage::disk('public')->assertExists($tour->thumbnail);
});

test('authenticated user can delete a tour', function () {
    Storage::fake('public');
    $user = User::factory()->create();

    $tour = Tour::create([
        'title' => 'Tour Bromo Midnight',
        'slug' => 'tour-bromo-midnight',
        'location' => 'Malang, Jawa Timur',
        'price' => 650000,
        'duration' => '1 Hari',
        'thumbnail' => 'tours/bromo.jpg',
        'is_published' => true,
        'is_popular' => false,
    ]);

    $response = $this
        ->actingAs($user)
        ->delete(route('tours.destroy', $tour));

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('tours.index'))
        ->assertSessionHas('success');

    $this->assertDatabaseMissing('tours', [
        'id' => $tour->id,
    ]);
});

test('cannot delete a tour if it has associated bookings', function () {
    $user = User::factory()->create();

    $tour = Tour::create([
        'title' => 'Tour Komodo Adventure',
        'slug' => 'tour-komodo-adventure',
        'location' => 'Labuan Bajo',
        'price' => 3000000,
        'duration' => '3D2N',
        'thumbnail' => 'tours/komodo.jpg',
        'is_published' => true,
        'is_popular' => false,
    ]);

    \App\Models\Booking::create([
        'tour_id' => $tour->id,
        'booking_code' => 'TRV-261119-KOMOD',
        'customer_name' => 'Budi Utomo',
        'customer_phone' => '081234567899',
        'travel_date' => now()->addDays(5)->format('Y-m-d'),
        'total_pax' => 2,
        'total_amount' => 6000000,
        'status' => 'pending',
    ]);

    $response = $this
        ->actingAs($user)
        ->delete(route('tours.destroy', $tour));

    $response
        ->assertRedirect(route('tours.index'))
        ->assertSessionHas('error');

    $this->assertDatabaseHas('tours', [
        'id' => $tour->id,
    ]);
});
