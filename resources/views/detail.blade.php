<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $tour->title }} — {{ config('app.name') }}</title>
    <meta name="description" content="Paket wisata {{ $tour->title }} di {{ $tour->location }}. Durasi {{ $tour->duration }}. Harga mulai {{ $tour->formatted_price }}.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">

    {{-- ===================== NAVBAR ===================== --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Logo --}}
                <a href="{{ route('welcome') }}" class="flex items-center gap-2.5 flex-shrink-0">
                    <div class="w-9 h-9 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold text-gray-900">{{ config('app.name') }}</span>
                </a>

                {{-- Right side --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('welcome') }}#katalog"
                       class="hidden sm:inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Semua Paket
                    </a>
                    @auth
                        <a href="{{ route('tours.index') }}"
                           class="inline-flex items-center gap-1.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            <span class="hidden sm:inline">Panel Admin</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center gap-1.5 border border-gray-300 hover:border-indigo-500 text-gray-700 hover:text-indigo-600 text-sm font-medium px-4 py-2 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                            </svg>
                            Login Admin
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- ===================== BREADCRUMB ===================== --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2.5">
            <nav class="flex items-center gap-2 text-xs text-gray-500">
                <a href="{{ route('welcome') }}" class="hover:text-indigo-600 transition-colors">Beranda</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('welcome') }}#katalog" class="hover:text-indigo-600 transition-colors">Paket Wisata</a>
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-gray-700 font-medium truncate max-w-[200px]">{{ $tour->title }}</span>
            </nav>
        </div>
    </div>

    {{-- ===================== MAIN CONTENT ===================== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ==================== KIRI: Konten Detail ==================== --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Thumbnail Gambar Besar --}}
                <div class="relative rounded-2xl overflow-hidden bg-gray-200 shadow-md">
                    <img
                        src="{{ $tour->thumbnail_url }}"
                        alt="{{ $tour->title }}"
                        class="w-full h-72 sm:h-96 object-cover"
                        onerror="this.src='https://placehold.co/900x500?text=No+Image'"
                    >
                    {{-- Badge overlay --}}
                    <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-1 bg-green-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Tersedia
                        </span>
                        @if($tour->is_popular)
                            <span class="inline-flex items-center gap-1 bg-yellow-400/90 backdrop-blur-sm text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shadow">
                                ★ Popular
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Judul & Lokasi --}}
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">{{ $tour->location }}</span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-900 leading-snug">{{ $tour->title }}</h1>
                </div>

                {{-- Info Chips --}}
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-3.5 shadow-sm">
                        <div class="w-9 h-9 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Durasi</p>
                            <p class="text-sm font-bold text-gray-900">{{ $tour->duration }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-3.5 shadow-sm">
                        <div class="w-9 h-9 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Lokasi</p>
                            <p class="text-sm font-bold text-gray-900">{{ $tour->location }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-3.5 shadow-sm col-span-2 sm:col-span-1">
                        <div class="w-9 h-9 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium">Harga/pax</p>
                            <p class="text-sm font-bold text-blue-600">{{ $tour->formatted_price }}</p>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                @if($tour->description)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                    <h2 class="text-base font-bold text-gray-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Deskripsi Paket
                    </h2>
                    <div class="text-sm text-gray-600 leading-relaxed space-y-2">
                        {!! nl2br(e($tour->description)) !!}
                    </div>
                </div>
                @endif

                {{-- Fasilitas Termasuk --}}
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                    <h2 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        Sudah Termasuk
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        @foreach ([
                            ['icon' => 'M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4', 'label' => 'Transportasi PP'],
                            ['icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'label' => 'Akomodasi hotel'],
                            ['icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z', 'label' => 'Tour guide profesional'],
                            ['icon' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z', 'label' => 'Tiket masuk wisata'],
                            ['icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253', 'label' => 'Makan sesuai program'],
                            ['icon' => 'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z', 'label' => 'Dokumentasi perjalanan'],
                        ] as $facility)
                            <div class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-gray-50 transition-colors">
                                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $facility['icon'] }}"/>
                                    </svg>
                                </div>
                                <span class="text-sm text-gray-700 font-medium">{{ $facility['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Kebijakan --}}
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5">
                    <h3 class="text-sm font-bold text-amber-800 mb-2 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Informasi Penting
                    </h3>
                    <ul class="text-xs text-amber-700 space-y-1.5 list-none">
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                            Harga dapat berubah sewaktu-waktu tergantung ketersediaan
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                            Konfirmasi keberangkatan minimal 3 hari sebelum perjalanan
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="mt-0.5 w-1.5 h-1.5 rounded-full bg-amber-500 flex-shrink-0"></span>
                            Pembayaran DP minimal 30% dari total harga paket
                        </li>
                    </ul>
                </div>

            </div>

            {{-- ==================== KANAN: Harga & Pemesanan ==================== --}}
            <div class="space-y-5">
                <div class="sticky top-20 space-y-5">

                    {{-- Box Harga --}}
                    <div class="bg-white rounded-2xl border-2 border-indigo-100 shadow-lg overflow-hidden">
                        {{-- Header harga --}}
                        <div class="bg-gradient-to-br from-indigo-600 to-blue-600 px-6 py-5 text-center">
                            <p class="text-indigo-200 text-xs font-semibold uppercase tracking-widest mb-1">Harga Per Orang</p>
                            <p class="text-4xl font-extrabold text-white">{{ $tour->formatted_price }}</p>
                            <p class="text-indigo-200 text-xs mt-1">/ pax (per tiket)</p>
                        </div>

                        {{-- Detail singkat --}}
                        <div class="px-6 py-4 space-y-3">
                            <div class="flex items-center justify-between text-sm py-1 border-b border-gray-100">
                                <span class="text-gray-500 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Durasi
                                </span>
                                <span class="font-semibold text-gray-800">{{ $tour->duration }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm py-1 border-b border-gray-100">
                                <span class="text-gray-500 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    Lokasi
                                </span>
                                <span class="font-semibold text-gray-800">{{ $tour->location }}</span>
                            </div>
                            <div class="flex items-center justify-between text-sm py-1">
                                <span class="text-gray-500 flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Status
                                </span>
                                <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                    Tersedia
                                </span>
                            </div>
                        </div>
                    </div>

                    {{-- Formulir Pemesanan --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                        <h3 class="text-base font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Formulir Pemesanan
                        </h3>

                        {{-- Alert Error Validasi --}}
                        @if ($errors->any())
                            <div class="mb-4 p-3.5 bg-red-50 border border-red-200 rounded-xl text-xs text-red-700 space-y-1">
                                <div class="font-bold flex items-center gap-1.5 text-red-800">
                                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Mohon periksa formulir Anda:
                                </div>
                                <ul class="list-disc list-inside space-y-0.5">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form
                            action="{{ route('booking.store') }}"
                            method="POST"
                            x-data="{
                                peserta: {{ old('total_pax', 1) }},
                                pricePerPax: {{ $tour->price }},
                                get totalAmount() {
                                    return this.pricePerPax * this.peserta;
                                },
                                get formattedTotal() {
                                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(this.totalAmount);
                                }
                            }"
                            class="space-y-4"
                        >
                            @csrf

                            {{-- Hidden tour_id --}}
                            <input type="hidden" name="tour_id" value="{{ $tour->id }}">

                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="customer_name" class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="customer_name"
                                    name="customer_name"
                                    value="{{ old('customer_name') }}"
                                    placeholder="Masukkan nama lengkap Anda"
                                    required
                                    class="w-full px-3.5 py-2.5 text-sm border @error('customer_name') border-red-300 bg-red-50/30 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400"
                                >
                                @error('customer_name')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Nomor Telepon / WhatsApp --}}
                            <div>
                                <label for="customer_phone" class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Nomor Telepon / WhatsApp <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="customer_phone"
                                    name="customer_phone"
                                    value="{{ old('customer_phone') }}"
                                    placeholder="Contoh: 081234567890"
                                    required
                                    class="w-full px-3.5 py-2.5 text-sm border @error('customer_phone') border-red-300 bg-red-50/30 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition placeholder-gray-400"
                                >
                                @error('customer_phone')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tanggal Keberangkatan --}}
                            <div>
                                <label for="travel_date" class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Tanggal Keberangkatan <span class="text-red-500">*</span>
                                </label>
                                <input
                                    type="date"
                                    id="travel_date"
                                    name="travel_date"
                                    value="{{ old('travel_date') }}"
                                    min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-3.5 py-2.5 text-sm border @error('travel_date') border-red-300 bg-red-50/30 @else border-gray-300 @enderror rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                >
                                @error('travel_date')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jumlah Peserta --}}
                            <div>
                                <label for="total_pax" class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Jumlah Peserta <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center border @error('total_pax') border-red-300 @else border-gray-300 @enderror rounded-xl overflow-hidden">
                                    <button
                                        type="button"
                                        @click="peserta = Math.max(1, peserta - 1)"
                                        class="px-4 py-2.5 text-gray-600 hover:bg-gray-100 font-bold text-lg transition-colors select-none"
                                    >−</button>
                                    <input
                                        type="number"
                                        id="total_pax"
                                        name="total_pax"
                                        x-model.number="peserta"
                                        min="1"
                                        max="50"
                                        required
                                        class="flex-1 text-center text-sm font-bold text-gray-900 py-2.5 border-none focus:outline-none focus:ring-0"
                                        readonly
                                    >
                                    <button
                                        type="button"
                                        @click="peserta = Math.min(50, peserta + 1)"
                                        class="px-4 py-2.5 text-gray-600 hover:bg-gray-100 font-bold text-lg transition-colors select-none"
                                    >+</button>
                                </div>
                                @error('total_pax')
                                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Kalkulasi Total Biaya --}}
                            <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-1">
                                    <span>Harga per orang</span>
                                    <span>{{ $tour->formatted_price }}</span>
                                </div>
                                <div class="flex items-center justify-between text-xs text-gray-500 mb-2">
                                    <span>Jumlah peserta</span>
                                    <span><span x-text="peserta"></span> orang</span>
                                </div>
                                <div class="pt-2 border-t border-indigo-100 flex items-center justify-between">
                                    <span class="text-xs font-bold text-gray-700 uppercase tracking-wide">Total Pembayaran</span>
                                    <span class="text-lg font-extrabold text-indigo-700" x-text="formattedTotal"></span>
                                </div>
                                <p class="text-[11px] text-indigo-500 mt-1.5">
                                    * Rumus: {{ $tour->formatted_price }} × <span x-text="peserta"></span> pax
                                </p>
                            </div>

                            {{-- Tombol Submit --}}
                            <button
                                type="submit"
                                class="w-full flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 active:bg-indigo-800 text-white font-bold py-3.5 px-6 rounded-xl transition-colors text-sm shadow-md shadow-indigo-600/20"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Pesan Sekarang
                            </button>
                            <p class="text-[11px] text-gray-400 text-center">
                                Data Anda aman dan akan segera kami proses untuk konfirmasi
                            </p>
                        </form>
                    </div>

                    {{-- Bagikan --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
                        <p class="text-xs font-semibold text-gray-600 mb-3 uppercase tracking-wide">Bagikan Paket</p>
                        <div class="flex gap-2">
                            <a href="https://wa.me/?text={{ urlencode($tour->title . ' - ' . url()->current()) }}"
                               target="_blank"
                               class="flex-1 flex items-center justify-center gap-1.5 bg-green-50 hover:bg-green-100 text-green-700 text-xs font-semibold py-2.5 rounded-xl transition-colors border border-green-100">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                WhatsApp
                            </a>
                            <button
                                onclick="navigator.clipboard.writeText(window.location.href).then(() => { this.textContent = '✓ Disalin!'; setTimeout(() => this.innerHTML = '<svg class=\'w-4 h-4\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg> Salin Link', 2000) })"
                                class="flex-1 flex items-center justify-center gap-1.5 bg-gray-50 hover:bg-gray-100 text-gray-600 text-xs font-semibold py-2.5 rounded-xl transition-colors border border-gray-200"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                                Salin Link
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </main>

    {{-- ===================== FOOTER ===================== --}}
    <footer class="bg-gray-900 text-gray-300 mt-16 py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="flex items-center justify-center gap-2 mb-3">
                <div class="w-8 h-8 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                    </svg>
                </div>
                <span class="text-white font-bold text-lg">{{ config('app.name') }}</span>
            </div>
            <p class="text-sm text-gray-400">Paket wisata terpercaya untuk pengalaman tak terlupakan</p>
            <p class="text-xs text-gray-600 mt-4">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
