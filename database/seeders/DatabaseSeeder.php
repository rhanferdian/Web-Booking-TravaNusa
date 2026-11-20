<?php

namespace Database\Seeders;

use App\Models\Tour;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::firstOrCreate(
            ['email' => 'reihanbusines@gmail.com'],
            [
                'name' => 'Rei',
                'password' => bcrypt('password'),
            ]
        );

        // 3 Dummy Data Tour
        $tours = [
            [
                'title' => 'Paket Wisata Eksotis Raja Ampat',
                'slug' => 'paket-wisata-eksotis-raja-ampat',
                'location' => 'Raja Ampat, Papua Barat',
                'price' => 4800000,
                'duration' => '4 Hari 3 Malam',
                'thumbnail' => 'https://images.unsplash.com/photo-1516690561799-46d8f74f9abf?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Nikmati Keindahan Sunrise di Gunung Bromo dan Jelajahi Kawahnnya',
                'is_popular' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Eksplorasi Keajaiban Labuan Bajo & Komodo',
                'slug' => 'eksplorasi-keajaiban-labuan-bajo-komodo',
                'location' => 'Labuan Bajo, NTT',
                'price' => 3500000,
                'duration' => '3 Hari 2 Malam',
                'thumbnail' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Nikmati Keindahan Sunrise di Gunung Bromo dan Jelajahi Kawahnnya',
                'is_popular' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Pesona Sunrise Bromo & Kawah Ijen',
                'slug' => 'pesona-sunrise-bromo-kawah-ijen',
                'location' => 'Bromo, Jawa Timur',
                'price' => 1250000,
                'duration' => '2 Hari 1 Malam',
                'thumbnail' => 'https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?auto=format&fit=crop&w=1200&q=80',
                'description' => 'Nikmati Keindahan Sunrise di Gunung Bromo dan Jelajahi Kawahnnya',
                'is_popular' => false,
                'is_published' => true,
            ],
        ];

        foreach ($tours as $tour) {
            Tour::updateOrCreate(
                ['slug' => $tour['slug']],
                $tour
            );
        }
    }
}
