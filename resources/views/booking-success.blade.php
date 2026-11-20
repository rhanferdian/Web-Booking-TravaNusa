<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Sukses #{{ $booking->booking_code }} — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased text-gray-800 min-h-screen flex flex-col justify-between">

    {{-- NAVBAR --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-40 print:hidden">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2.5">
                    <div class="w-9 h-9 bg-gradient-to-tr from-indigo-600 to-blue-500 rounded-xl flex items-center justify-center text-white shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                        </svg>
                    </div>
                    <span class="text-lg font-extrabold text-gray-900 tracking-tight">{{ config('app.name') }}</span>
                </a>

                <div class="flex items-center gap-2">
                    <button
                        onclick="window.print()"
                        type="button"
                        class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                    >
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                        </svg>
                        Cetak Tiket
                    </button>
                    <a
                        href="{{ route('welcome') }}"
                        class="text-xs font-medium text-indigo-600 hover:text-indigo-800 transition px-2 py-1.5"
                    >
                        ← Beranda
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="max-w-2xl mx-auto px-4 py-8 sm:py-12 flex-1 w-full">

        {{-- Toast / Notification Banner --}}
        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center gap-3 shadow-sm print:hidden">
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div>
                    <p class="font-bold">{{ session('success') }}</p>
                    <p class="text-xs text-emerald-700">Silakan simpan kode booking Anda untuk proses verifikasi dan pembayaran.</p>
                </div>
            </div>
        @endif

        {{-- INVOICE / TIKET CARD --}}
        <div class="bg-white rounded-3xl border border-gray-200 shadow-xl overflow-hidden">

            {{-- 1. HEADER : KODE BOOKING & STATUS BADGE --}}
            <div class="bg-gradient-to-r from-indigo-700 via-indigo-600 to-blue-600 p-6 sm:p-8 text-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-indigo-200 text-xs font-semibold uppercase tracking-widest mb-1.5">
                            <svg class="w-4 h-4 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                            KODE BOOKING
                        </div>
                        {{-- 1. Header Kode Booking Utama --}}
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl sm:text-3xl font-mono font-extrabold tracking-wider text-white">
                                {{ $booking->booking_code }}
                            </h1>
                            <button
                                onclick="navigator.clipboard.writeText('{{ $booking->booking_code }}').then(() => alert('Kode booking berhasil disalin!'))"
                                type="button"
                                title="Salin Kode Booking"
                                class="p-1.5 rounded-lg bg-white/10 hover:bg-white/20 text-indigo-100 transition print:hidden"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-indigo-200 mt-1">Dibuat pada {{ $booking->created_at ? $booking->created_at->format('d M Y, H:i') : now()->format('d M Y, H:i') }} WIB</p>
                    </div>

                    {{-- 2. STATUS BADGE : PENDING (WARNA KUNING) --}}
                    <div class="self-start sm:self-center">
                        @if ($booking->status === 'confirmed')
                            <span class="inline-flex items-center gap-1.5 bg-emerald-100 text-emerald-800 border border-emerald-300 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                Confirmed
                            </span>
                        @elseif ($booking->status === 'canceled')
                            <span class="inline-flex items-center gap-1.5 bg-rose-100 text-rose-800 border border-rose-300 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm">
                                <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                Canceled
                            </span>
                        @else
                            {{-- Status Badge Pending Warna Kuning --}}
                            <span class="inline-flex items-center gap-1.5 bg-yellow-100 text-yellow-800 border border-yellow-300 px-3.5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider shadow-sm ring-2 ring-yellow-400/20">
                                <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                Pending
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- TIKET PERFORATION / NOTCH EFFECT --}}
            <div class="relative bg-white py-1">
                <div class="border-b-2 border-dashed border-gray-200 mx-6"></div>
                <div class="absolute -left-3 -top-3 w-6 h-6 bg-slate-50 rounded-full border-r border-gray-200"></div>
                <div class="absolute -right-3 -top-3 w-6 h-6 bg-slate-50 rounded-full border-l border-gray-200"></div>
            </div>

            <div class="p-6 sm:p-8 space-y-6">

                {{-- PAKET WISATA INFORMATION --}}
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 flex items-center gap-4">
                    <img
                        src="{{ $booking->tour->thumbnail_url }}"
                        alt="{{ $booking->tour->title }}"
                        class="w-20 h-20 rounded-xl object-cover flex-shrink-0 shadow-sm border border-gray-200"
                        onerror="this.src='https://placehold.co/200x200?text=Tour'"
                    >
                    <div class="min-w-0 flex-1">
                        <span class="text-[11px] font-bold text-indigo-600 uppercase tracking-wider">{{ $booking->tour->location }}</span>
                        <h2 class="text-base font-bold text-gray-900 truncate">{{ $booking->tour->title }}</h2>
                        <div class="flex flex-wrap items-center gap-3 text-xs text-gray-500 mt-1">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $booking->tour->duration }}
                            </span>
                            <span>•</span>
                            <span class="text-gray-700 font-semibold">{{ $booking->tour->formatted_price }} / pax</span>
                        </div>
                    </div>
                </div>

                {{-- 3. RINCIAN DATA CUSTOMER --}}
                <div>
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        Rincian Data Customer
                    </h3>

                    <div class="border border-gray-100 rounded-2xl overflow-hidden divide-y divide-gray-100 text-sm">
                        {{-- Nama Customer --}}
                        <div class="flex items-center justify-between p-3.5 bg-gray-50/60">
                            <span class="text-gray-500">Nama Customer</span>
                            <span class="font-bold text-gray-900 text-right">{{ $booking->customer_name }}</span>
                        </div>

                        {{-- Nomor Telepon --}}
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-gray-500">Nomor Telepon / WhatsApp</span>
                            <span class="font-semibold text-gray-900 font-mono">{{ $booking->customer_phone }}</span>
                        </div>

                        {{-- Tanggal Keberangkatan --}}
                        <div class="flex items-center justify-between p-3.5 bg-gray-50/60">
                            <span class="text-gray-500">Tanggal Keberangkatan</span>
                            <span class="font-bold text-indigo-700 text-right">
                                {{ \Carbon\Carbon::parse($booking->travel_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                            </span>
                        </div>

                        {{-- Jumlah Peserta --}}
                        <div class="flex items-center justify-between p-3.5">
                            <span class="text-gray-500">Jumlah Peserta</span>
                            <span class="font-semibold text-gray-900">{{ $booking->total_pax }} Orang (Pax)</span>
                        </div>
                    </div>
                </div>

                {{-- 4. TOTAL TAGIHAN (FORMAT RUPIAH) --}}
                <div class="bg-gradient-to-br from-indigo-50 to-blue-50 border-2 border-indigo-200/80 rounded-2xl p-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                        <div>
                            <span class="text-xs font-bold text-indigo-900 uppercase tracking-wider block">Total Tagihan</span>
                            <span class="text-xs text-gray-500">
                                Kalkulasi: {{ $booking->tour->formatted_price }} × {{ $booking->total_pax }} pax
                            </span>
                        </div>
                        <div class="text-left sm:text-right">
                            {{-- Format Rupiah Total Tagihan --}}
                            <p class="text-2xl sm:text-3xl font-extrabold text-indigo-700 tracking-tight">
                                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- PETUNJUK PEMBAYARAN --}}
                <div class="p-4 bg-amber-50 border border-amber-200 rounded-2xl text-xs text-amber-800 space-y-1">
                    <p class="font-bold flex items-center gap-1.5 text-amber-900">
                        <svg class="w-4 h-4 text-amber-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Instruksi Konfirmasi Pembayaran:
                    </p>
                    <p class="text-amber-700 leading-relaxed">
                        Status pesanan saat ini adalah <strong class="text-amber-900 font-bold">Pending</strong>. Silakan hubungi admin kami melalui WhatsApp untuk konfirmasi ketersediaan kuota dan pembayaran DP/pelunasan.
                    </p>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="space-y-3 pt-2 print:hidden">
                    {{-- Tombol Konfirmasi WA --}}
                    @php
                        $waNumber = \App\Models\Setting::getValue('whatsapp_number', '6281234567890');
                        $waText = "Halo Admin TravaNusa, saya telah melakukan pemesanan paket wisata:\n\n"
                            . "🔖 *Kode Booking:* {$booking->booking_code}\n"
                            . "👤 *Nama Customer:* {$booking->customer_name}\n"
                            . "🏖️ *Paket:* {$booking->tour->title}\n"
                            . "📅 *Tanggal:* " . \Carbon\Carbon::parse($booking->travel_date)->locale('id')->isoFormat('D MMMM Y') . "\n"
                            . "👥 *Jumlah:* {$booking->total_pax} orang\n"
                            . "💰 *Total Tagihan:* Rp " . number_format($booking->total_amount, 0, ',', '.') . "\n\n"
                            . "Mohon info rekening dan petunjuk pembayaran. Terima kasih!";
                    @endphp
                    <a
                        href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waText) }}"
                        target="_blank"
                        class="w-full flex items-center justify-center gap-2.5 bg-emerald-500 hover:bg-emerald-600 active:bg-emerald-700 text-white font-bold py-3.5 px-6 rounded-xl transition-colors shadow-lg shadow-emerald-500/25 text-sm"
                    >
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Konfirmasi Pembayaran via WhatsApp
                    </a>

                    <div class="flex items-center gap-3">
                        <button
                            type="button"
                            onclick="window.print()"
                            class="flex-1 py-3 px-4 rounded-xl border border-gray-300 hover:bg-gray-50 text-gray-700 text-xs font-bold transition flex items-center justify-center gap-1.5"
                        >
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                            </svg>
                            Cetak Bukti Pemesanan
                        </button>
                        <a
                            href="{{ route('welcome') }}"
                            class="flex-1 py-3 px-4 rounded-xl border border-indigo-200 hover:bg-indigo-50 text-indigo-700 text-xs font-bold transition flex items-center justify-center gap-1.5 text-center"
                        >
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </main>

    {{-- FOOTER --}}
    <footer class="bg-white border-t border-gray-100 py-6 text-center text-xs text-gray-400 print:hidden">
        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
    </footer>

</body>
</html>
