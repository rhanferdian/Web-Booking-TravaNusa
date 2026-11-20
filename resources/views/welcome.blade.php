<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TravelKita') }} - Jelajahi Keindahan Nusantara</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles via Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100" x-data="{ mobileMenu: false, selectedTour: null }">

    <!-- ======================================================== -->
    <!-- 1. NAVBAR                                                -->
    <!-- ======================================================== -->
    <nav class="sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Brand Logo -->
                <a href="{{ route('welcome') }}" class="flex items-center gap-3 group flex-shrink-0">
                    <div class="w-9 h-9 lg:w-10 lg:h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-blue-500 flex items-center justify-center text-white shadow-md shadow-indigo-500/20 group-hover:scale-105 transition">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-lg lg:text-xl font-extrabold tracking-tight bg-gradient-to-r from-gray-900 to-indigo-600 dark:from-white dark:to-indigo-400 bg-clip-text text-transparent">
                        Trava<span class="text-indigo-600 dark:text-indigo-400">Nusa</span>
                    </span>
                </a>

                <!-- Desktop Navigation Links (lg dan ke atas) -->
                <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                    <a href="#hero" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Beranda</a>
                    <a href="#katalog" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Paket Wisata</a>
                    <a href="#keunggulan" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Keunggulan</a>
                    <a href="#testimoni" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Testimoni</a>
                    <a href="#kontak" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 transition">Kontak</a>
                </div>

                <!-- Admin Action Button (tablet: compact, desktop: full) -->
                <div class="hidden md:flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ route('tours.index') }}" class="inline-flex items-center px-3 py-2 lg:px-4 lg:py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm shadow-indigo-600/30 transition">
                                <svg class="w-4 h-4 lg:me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                </svg>
                                <span class="hidden lg:inline">Kelola Tour (Admin)</span>
                                <span class="lg:hidden">Admin</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-3 py-2 lg:px-4 lg:py-2 bg-gray-900 hover:bg-gray-800 dark:bg-gray-800 dark:hover:bg-gray-700 text-white text-sm font-semibold rounded-lg shadow-sm transition border border-gray-700/50">
                                <svg class="w-4 h-4 lg:me-1.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="hidden lg:inline">Login Admin</span>
                                <span class="lg:hidden">Login</span>
                            </a>
                        @endauth
                    @endif
                </div>

                <!-- Mobile & Tablet Hamburger Button -->
                <div class="flex lg:hidden items-center gap-2">
                    <!-- Tombol admin compact untuk tablet (md..lg) -->
                    <div class="hidden md:flex lg:hidden">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('tours.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                    </svg>
                                    Admin
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-900 dark:bg-gray-800 text-white text-xs font-semibold rounded-lg transition border border-gray-700/50">
                                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                                    </svg>
                                    Login
                                </a>
                            @endauth
                        @endif
                    </div>
                    <button @click="mobileMenu = !mobileMenu" type="button" class="p-2 text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenu">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenu" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Dropdown (< lg) -->
        <div x-show="mobileMenu" x-transition class="lg:hidden border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 px-4 pt-2 pb-6 space-y-1" style="display: none;">
            <a href="#hero" @click="mobileMenu = false" class="block px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition">Beranda</a>
            <a href="#katalog" @click="mobileMenu = false" class="block px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition">Paket Wisata</a>
            <a href="#keunggulan" @click="mobileMenu = false" class="block px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition">Keunggulan</a>
            <a href="#testimoni" @click="mobileMenu = false" class="block px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition">Testimoni</a>
            <a href="#kontak" @click="mobileMenu = false" class="block px-3 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-indigo-600 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition">Kontak</a>
            <!-- Tombol admin di mobile menu (mobile only, bukan tablet) -->
            <div class="pt-3 border-t border-gray-100 dark:border-gray-800 md:hidden">
                @auth
                    <a href="{{ route('tours.index') }}" class="w-full text-center block px-4 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold">
                        Kelola Tour (Admin)
                    </a>
                @else
                    <a href="{{ route('login') }}" class="w-full text-center block px-4 py-2.5 bg-gray-900 dark:bg-gray-800 text-white rounded-lg text-sm font-semibold">
                        Login Admin
                    </a>
                @endauth
            </div>
        </div>
    </nav>


    <!-- ======================================================== -->
    <!-- 2. HERO SECTION                                          -->
    <!-- ======================================================== -->
    <section id="hero" class="relative overflow-hidden bg-slate-900 text-white py-20 lg:py-28">
        <!-- Background Gradient and Glow Accent -->
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-950 via-slate-900 to-slate-950 opacity-90"></div>
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-500/10 border border-indigo-400/30 text-indigo-300 text-xs sm:text-sm font-medium mb-6">
                <span class="w-2 h-2 rounded-full bg-indigo-400 animate-pulse"></span>
                Platform Tour & Wisata Terbaik di Nusantara
            </div>

            <!-- Headline -->
            <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight max-w-4xl mx-auto leading-tight sm:leading-tight">
                Jelajahi Pesona <span class="bg-gradient-to-r from-blue-400 via-indigo-300 to-teal-300 bg-clip-text text-transparent">Nusantara</span>, Ciptakan Momen Abadi
            </h1>

            <p class="mt-6 text-base sm:text-lg text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Temukan berbagai paket liburan ke destinasi ikonik Indonesia seperti Raja Ampat, Labuan Bajo, Bali, hingga Bromo dengan fasilitas premium dan harga terbaik.
            </p>


            <!-- Stats Bar -->
            <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-6 pt-12 border-t border-white/10 max-w-4xl mx-auto">
                <div>
                    <div class="text-3xl font-extrabold text-white">50+</div>
                    <div class="text-xs sm:text-sm text-gray-400 mt-1">Destinasi Wisata</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-white">10.000+</div>
                    <div class="text-xs sm:text-sm text-gray-400 mt-1">Traveler Puas</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-white">4.9 / 5</div>
                    <div class="text-xs sm:text-sm text-gray-400 mt-1">Rating Ulasan</div>
                </div>
                <div>
                    <div class="text-3xl font-extrabold text-white">100%</div>
                    <div class="text-xs sm:text-sm text-gray-400 mt-1">Aman & Terpercaya</div>
                </div>
            </div>
        </div>
    </section>


    <!-- ======================================================== -->
    <!-- 3. KATALOG PAKET WISATA / TOUR (FITUR SEARCH)           -->
    <!-- ======================================================== -->
    <section id="katalog" class="py-20 bg-white dark:bg-gray-800 transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block mb-2">
                    Katalog Paket Tour
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                    Pilihan Paket Wisata Terbaik
                </h2>
                <p class="mt-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    Temukan paket liburan impian yang sesuai dengan waktu dan budget liburan Anda.
                </p>
            </div>

            <!-- Search Form Card -->
            <div class="max-w-2xl mx-auto mb-12">
                <form action="{{ route('welcome') }}#katalog" method="GET" class="flex flex-col sm:flex-row gap-3 p-2 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-4 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Cari destinasi atau nama paket (misal: Bali, Raja Ampat)..."
                            class="w-full ps-11 pe-4 py-3 bg-transparent border-0 focus:ring-0 text-sm text-gray-900 dark:text-white placeholder-gray-400"
                        >
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-sm transition">
                            Cari Tour
                        </button>
                        @if (!empty($search))
                            <a href="{{ route('welcome') }}#katalog" class="px-4 py-3 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 font-medium text-sm rounded-xl transition" title="Reset">
                                Reset
                            </a>
                        @endif
                    </div>
                </form>

                @if (!empty($search))
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-2 text-center">
                        Hasil pencarian untuk: <strong class="text-indigo-600 dark:text-indigo-400">"{{ $search }}"</strong> ({{ $tours->count() }} paket ditemukan)
                    </p>
                @endif
            </div>

            <!-- Tours Grid -->
            @if ($tours->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($tours as $tour)
                        <div class="group bg-white dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl hover:-translate-y-1 transition duration-200 flex flex-col overflow-hidden">
                            <!-- Image Container -->
                            <div class="relative h-56 bg-gray-100 dark:bg-gray-800 overflow-hidden">
                                <img
                                    src="{{ $tour->thumbnail_url }}"
                                    alt="{{ $tour->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                    loading="lazy"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                                <!-- Popular Badge -->
                                @if ($tour->is_popular)
                                    <div class="absolute top-3 start-3">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-500 text-white shadow-md">
                                            ★ Popular Tour
                                        </span>
                                    </div>
                                @endif

                                <!-- Location tag on image -->
                                <div class="absolute bottom-3 start-3 flex items-center gap-1.5 text-white text-xs font-medium bg-black/40 backdrop-blur-sm px-2.5 py-1 rounded-md">
                                    <svg class="w-3.5 h-3.5 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span>{{ $tour->location }}</span>
                                </div>
                            </div>

                            <!-- Card Content -->
                            <div class="p-6 flex-1 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center gap-2 text-xs font-medium text-indigo-600 dark:text-indigo-400 mb-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span>Durasi: {{ $tour->duration }}</span>
                                    </div>

                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white line-clamp-2 mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                        {{ $tour->title }}
                                    </h3>
                                </div>

                                <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-between">
                                    <div>
                                        <span class="text-xs text-gray-400 block">Mulai dari</span>
                                        <span class="text-lg font-extrabold text-indigo-600 dark:text-indigo-400">
                                            {{ $tour->formatted_price }}
                                        </span>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button
                                            type="button"
                                            @click="selectedTour = {{ json_encode([
                                                'title' => $tour->title,
                                                'location' => $tour->location,
                                                'duration' => $tour->duration,
                                                'price' => $tour->formatted_price,
                                                'thumbnail' => $tour->thumbnail_url,
                                                'is_popular' => $tour->is_popular
                                            ]) }}"
                                            class="inline-flex items-center px-3 py-2 bg-indigo-50 dark:bg-indigo-950/60 hover:bg-indigo-600 dark:hover:bg-indigo-600 text-indigo-600 dark:text-indigo-300 hover:text-white dark:hover:text-white text-xs font-bold rounded-lg transition duration-150"
                                        >
                                            Detail Singkat
                                        </button>
                                        <a
                                            href="{{ route('tours.detail', $tour) }}"
                                            class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold rounded-lg transition duration-150"
                                        >
                                            Lihat Detail
                                            <svg class="w-3.5 h-3.5 ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 px-4 bg-gray-50 dark:bg-gray-900/50 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
                    <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tidak ada paket wisata ditemukan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 max-w-sm mx-auto">
                        Coba gunakan kata kunci pencarian yang lain atau reset filter untuk melihat semua pilihan destinasi.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('welcome') }}#katalog" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                            Tampilkan Semua Tour
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </section>


    <!-- ======================================================== -->
    <!-- 4. KEUNGGULAN (WHY CHOOSE US)                             -->
    <!-- ======================================================== -->
    <section id="keunggulan" class="py-20 bg-gray-50 dark:bg-gray-900 transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block mb-2">
                    Kenapa Memilih Kami
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                    Keunggulan Layanan Kami
                </h2>
                <p class="mt-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    Kami memastikan setiap perjalanan liburan Anda aman, nyaman, dan berkesan dari awal hingga akhir.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-indigo-100 dark:bg-indigo-950/70 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Harga Transparan</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Tanpa biaya tersembunyi (*no hidden fees*). Semua biaya paket telah tertera jelas dengan garansi harga terbaik.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-950/70 text-blue-600 dark:text-blue-400 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Tour Guide Berlisensi</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Dipandu oleh pemandu lokal berlisensi resmi, ramah, dan menguasai informasi sejarah serta budaya destinasi.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/70 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Akomodasi & Armada Prima</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Kendaraan terawat, bersih, ber-AC, serta hotel mitra pilihan berkualitas untuk kenyamanan istirahat Anda.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-950/70 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Bantuan Pelanggan 24/7</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                        Tim support kami selalu siap sedia merespon dan mendampingi kebutuhan Anda sebelum, saat, dan sesudah liburan.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- ======================================================== -->
    <!-- 5. ULASAN / TESTIMONI                                     -->
    <!-- ======================================================== -->
    <section id="testimoni" class="py-20 bg-white dark:bg-gray-800 transition">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400 block mb-2">
                    Testimoni Pelanggan
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 dark:text-white">
                    Apa Kata Mereka Tentang Kami?
                </h2>
                <p class="mt-3 text-sm sm:text-base text-gray-600 dark:text-gray-400">
                    Ribuan traveler telah mempercayakan liburan mereka kepada kami. Simak cerita mereka!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                    <div>
                        <!-- 5 Star Rating -->
                        <div class="flex items-center gap-1 text-amber-400 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 italic leading-relaxed">
                            "Trip ke Raja Ampat kemarin benar-benar luar biasa! Pemandunya ramah banget, makanan enak, dan jadwalnya sangat teratur tanpa bikin capek. Sangat recommended buat liburan keluarga!"
                        </p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-rose-400 flex items-center justify-center text-white font-bold text-sm">
                            AN
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Anindya Putri</h4>
                            <span class="text-xs text-indigo-600 dark:text-indigo-400">Trip Raja Ampat 4D3N</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 2 -->
                <div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 italic leading-relaxed">
                            "Booking paket wisata Nusa Penida di sini sangat praktis. Begitu sampai pelabuhan Sanur langsung diurus tiket speed boat dan hotelnya mantap view laut. Pasti bakal pesan lagi di sini!"
                        </p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-500 to-blue-400 flex items-center justify-center text-white font-bold text-sm">
                            RD
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Rizky Dharmawan</h4>
                            <span class="text-xs text-indigo-600 dark:text-indigo-400">Paket Wisata Nusa Penida Bali</span>
                        </div>
                    </div>
                </div>

                <!-- Testimonial 3 -->
                <div class="p-8 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-100 dark:border-gray-800 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-1 text-amber-400 mb-4">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm text-gray-700 dark:text-gray-300 italic leading-relaxed">
                            "First time coba open trip ke Bromo sendirian, tapi langsung berbaur dan teman-teman satu trip seru semua. Driver jeep jago banget dan fotografernya bikin hasil foto Instagramable!"
                        </p>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-800 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-emerald-500 to-teal-400 flex items-center justify-center text-white font-bold text-sm">
                            SM
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white">Sarah Maharani</h4>
                            <span class="text-xs text-indigo-600 dark:text-indigo-400">Midnight Trip Bromo Sunrise</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ======================================================== -->
    <!-- 6. FOOTER                                                -->
    <!-- ======================================================== -->
    <footer id="kontak" class="bg-gray-900 text-gray-300 border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-extrabold text-white">TravaNusa</span>
                    </div>
                    <p class="text-sm text-gray-400 leading-relaxed">
                        Penyedia layanan paket wisata terpercaya di Indonesia dengan komitmen memberikan pengalaman liburan terbaik, aman, dan berkesan.
                    </p>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Navigasi</h3>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#hero" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="#katalog" class="hover:text-white transition">Paket Wisata</a></li>
                        <li><a href="#keunggulan" class="hover:text-white transition">Keunggulan Layanan</a></li>
                        <li><a href="#testimoni" class="hover:text-white transition">Ulasan Pelanggan</a></li>
                        <li><a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 transition">Portal Login Admin</a></li>
                    </ul>
                </div>

                <!-- Col 3: Destinasi Populer -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Destinasi Populer</h3>
                    <ul class="space-y-2.5 text-sm text-gray-400">
                        <li>Pulau Bali & Nusa Penida</li>
                        <li>Kepulauan Raja Ampat</li>
                        <li>Taman Nasional Labuan Bajo</li>
                        <li>Gunung Bromo & Kawah Ijen</li>
                        <li>Danau Toba, Sumatera Utara</li>
                    </ul>
                </div>

                <!-- Col 4: Kontak Kami -->
                <div>
                    <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Kontak Kami</h3>
                    @php
                        $waNumber = \App\Models\Setting::getValue('whatsapp_number', '6281234567890');
                        $waFormatted = '+' . substr($waNumber, 0, 2) . ' ' . substr($waNumber, 2, 3) . '-' . substr($waNumber, 5, 4) . '-' . substr($waNumber, 9);
                    @endphp
                    <ul class="space-y-3 text-sm text-gray-400">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span>Jl. Pariwisata Nusantara No. 88, Denpasar, Bali, Indonesia</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="hover:text-white transition">
                                {{ $waFormatted }}
                            </a>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-indigo-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <span>halo@travanusa.co.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="pt-10 mt-10 border-t border-gray-800 text-center text-xs text-gray-500 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p>&copy; {{ date('Y') }} TravaNusa Indonesia. Hak Cipta Dilindungi.</p>
                <div class="flex items-center space-x-6">
                    <a href="#" class="hover:text-gray-400 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-gray-400 transition">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>


    <!-- ======================================================== -->
    <!-- MODAL DETAIL PAKET WISATA (ALPINE.JS)                    -->
    <!-- ======================================================== -->
    <div
        x-show="selectedTour"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 overflow-y-auto bg-black/70 backdrop-blur-sm flex items-center justify-center p-4"
        style="display: none;"
    >
        <div
            @click.away="selectedTour = null"
            class="bg-white dark:bg-gray-800 rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl border border-gray-100 dark:border-gray-700 transform transition-all"
        >
            <template x-if="selectedTour">
                <div>
                    <!-- Modal Image Banner -->
                    <div class="relative h-60 bg-gray-900 overflow-hidden">
                        <img :src="selectedTour.thumbnail" :alt="selectedTour.title" class="w-full h-full object-cover">
                        <button
                            @click="selectedTour = null"
                            class="absolute top-3 end-3 w-8 h-8 rounded-full bg-black/60 text-white flex items-center justify-center hover:bg-black/80 transition"
                        >
                            &times;
                        </button>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between gap-2 text-xs font-semibold text-indigo-600 dark:text-indigo-400 mb-2">
                            <span x-text="selectedTour.location"></span>
                            <span class="px-2 py-0.5 rounded bg-indigo-50 dark:bg-indigo-950/60" x-text="selectedTour.duration"></span>
                        </div>

                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3" x-text="selectedTour.title"></h3>

                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/60 border border-gray-100 dark:border-gray-700 my-4 flex items-center justify-between">
                            <span class="text-xs text-gray-500 dark:text-gray-400">Harga Paket / Orang</span>
                            <span class="text-xl font-extrabold text-indigo-600 dark:text-indigo-400" x-text="selectedTour.price"></span>
                        </div>

                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">
                            Paket sudah termasuk transportasi lokal, akomodasi hotel, tiket masuk objek wisata, dan pemandu berpengalaman.
                        </p>

                        <div class="flex items-center gap-3">
                            <button
                                @click="selectedTour = null"
                                type="button"
                                class="w-1/3 py-2.5 px-4 rounded-xl border border-gray-300 dark:border-gray-600 text-xs font-semibold text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition"
                            >
                                Tutup
                            </button>
                            <a
                                :href="'https://wa.me/{{ \App\Models\Setting::getValue('whatsapp_number', '6281234567890') }}?text=' + encodeURIComponent('Halo TravaNusa, saya tertarik untuk memesan paket wisata: ' + selectedTour.title + ' (' + selectedTour.location + ')') "
                                target="_blank"
                                class="w-2/3 py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold text-center inline-flex items-center justify-center gap-1.5 shadow-md shadow-emerald-600/20 transition"
                            >
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                Pesan via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

{{-- Floating WhatsApp Button --}}
@php
    $waNumber = \App\Models\Setting::getValue('whatsapp_number', '6281234567890');
    $waGreeting = 'Halo Admin TravaNusa, saya ingin bertanya tentang paket wisata.';
@endphp

<a
    href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waGreeting) }}"
    target="_blank"
    rel="noopener noreferrer"
    aria-label="Tanya CS WhatsApp"
    style="position: fixed; bottom: 24px; right: 24px; z-index: 40;"
    class="inline-flex items-center gap-2.5 rounded-full bg-emerald-700 hover:bg-emerald-600 active:bg-emerald-800 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-950/40 transition-all duration-200 hover:-translate-y-0.5"
>
    <span>Tanya CS WhatsApp</span>
    <svg width="20" height="20" class="w-5 h-5 fill-current shrink-0" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

</body>
</html>
