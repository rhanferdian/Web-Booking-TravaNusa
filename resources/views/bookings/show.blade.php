<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('bookings.index') }}" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" title="Kembali">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Detail Booking') }} <span class="text-indigo-600 dark:text-indigo-400 font-mono">#{{ $booking->booking_code }}</span>
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                        {{ __('Informasi lengkap pesanan tiket paket wisata customer.') }}
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                @php
                    $waText = "Halo {$booking->customer_name}, kami dari tim TravaNusa mengonfirmasi pemesanan Anda dengan kode booking *{$booking->booking_code}* untuk paket *{$booking->tour->title}*.\nStatus saat ini: *" . ucfirst($booking->status) . "*.\nTotal Tagihan: Rp " . number_format($booking->total_amount, 0, ',', '.') . ".\nAda yang bisa kami bantu?";
                @endphp
                <a
                    href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_phone) }}?text={{ urlencode($waText) }}"
                    target="_blank"
                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold rounded-lg shadow-sm transition"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat Customer
                </a>

                <a
                    href="{{ route('bookings.edit', $booking) }}"
                    class="inline-flex items-center gap-1.5 px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 text-xs font-semibold rounded-lg shadow-sm transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>

                <form
                    action="{{ route('bookings.destroy', $booking) }}"
                    method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')"
                    class="inline"
                >
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="inline-flex items-center gap-1.5 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg shadow-sm transition"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Summary Top Card -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block">Kode Booking</span>
                        <div class="flex items-center gap-3 mt-1">
                            <h3 class="text-3xl font-mono font-extrabold text-gray-900 dark:text-white">{{ $booking->booking_code }}</h3>
                            <button
                                onclick="navigator.clipboard.writeText('{{ $booking->booking_code }}').then(() => alert('Kode booking disalin!'))"
                                class="text-xs text-indigo-600 hover:underline"
                            >
                                Salin
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Dibuat pada {{ $booking->created_at->format('d F Y, H:i') }} WIB
                        </p>
                    </div>

                    <div>
                        <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider block mb-1.5 sm:text-end">Status Pesanan</span>
                        <div class="sm:text-end">
                            @if ($booking->status === 'confirmed')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-300">
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                    Confirmed (Dikonfirmasi)
                                </span>
                            @elseif ($booking->status === 'canceled')
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300 border border-rose-300">
                                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                                    Canceled (Dibatalkan)
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 dark:bg-yellow-950 dark:text-yellow-300 border border-yellow-300">
                                    <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span>
                                    Pending (Menunggu Konfirmasi)
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Customer & Tour Details -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Rincian Data Customer -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Pemesan / Customer
                        </h3>

                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                            <div class="p-3.5 bg-gray-50 dark:bg-gray-700/40 rounded-xl">
                                <dt class="text-xs text-gray-400 font-medium">Nama Lengkap</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white mt-0.5">{{ $booking->customer_name }}</dd>
                            </div>

                            <div class="p-3.5 bg-gray-50 dark:bg-gray-700/40 rounded-xl">
                                <dt class="text-xs text-gray-400 font-medium">Nomor WhatsApp / HP</dt>
                                <dd class="text-base font-mono font-bold text-gray-900 dark:text-white mt-0.5">{{ $booking->customer_phone }}</dd>
                            </div>

                            <div class="p-3.5 bg-gray-50 dark:bg-gray-700/40 rounded-xl">
                                <dt class="text-xs text-gray-400 font-medium">Tanggal Keberangkatan</dt>
                                <dd class="text-base font-bold text-indigo-600 dark:text-indigo-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($booking->travel_date)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                </dd>
                            </div>

                            <div class="p-3.5 bg-gray-50 dark:bg-gray-700/40 rounded-xl">
                                <dt class="text-xs text-gray-400 font-medium">Jumlah Peserta</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white mt-0.5">{{ $booking->total_pax }} Orang (Pax)</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Informasi Paket Wisata -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider mb-4 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                            Paket Wisata yang Dipilih
                        </h3>

                        @if ($booking->tour)
                            <div class="flex flex-col sm:flex-row gap-4 items-start">
                                <img
                                    src="{{ $booking->tour->thumbnail_url }}"
                                    alt="{{ $booking->tour->title }}"
                                    class="w-full sm:w-36 h-28 rounded-xl object-cover border border-gray-200 dark:border-gray-700 shadow-sm"
                                    onerror="this.src='https://placehold.co/300x200?text=Tour'"
                                >
                                <div class="space-y-1.5 flex-1">
                                    <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-wider">{{ $booking->tour->location }}</span>
                                    <h4 class="text-lg font-bold text-gray-900 dark:text-white leading-snug">{{ $booking->tour->title }}</h4>
                                    <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500 dark:text-gray-400 pt-1">
                                        <span>Durasi: <strong class="text-gray-700 dark:text-gray-300">{{ $booking->tour->duration }}</strong></span>
                                        <span>•</span>
                                        <span>Harga Normal: <strong class="text-indigo-600 dark:text-indigo-400">{{ $booking->tour->formatted_price }}</strong> / pax</span>
                                    </div>
                                    <div class="pt-2">
                                        <a
                                            href="{{ route('tours.show', $booking->tour) }}"
                                            class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline inline-flex items-center gap-1"
                                        >
                                            Lihat Master Tour →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-gray-400 italic">Data paket wisata master sudah dihapus dari sistem.</p>
                        @endif
                    </div>

                </div>

                <!-- Right Column: Tagihan & Pembayaran -->
                <div class="space-y-6">

                    <!-- Box Rincian Tagihan -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border-2 border-indigo-100 dark:border-indigo-900 p-6 space-y-4">
                        <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">
                            Rincian Pembayaran
                        </h3>

                        <div class="space-y-2.5 text-sm divide-y divide-gray-100 dark:divide-gray-700">
                            <div class="flex justify-between text-gray-500 dark:text-gray-400 pt-1">
                                <span>Harga Tiket per Pax</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    Rp {{ number_format($booking->tour ? $booking->tour->price : ($booking->total_amount / max(1, $booking->total_pax)), 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="flex justify-between text-gray-500 dark:text-gray-400 pt-2.5">
                                <span>Jumlah Peserta</span>
                                <span class="font-semibold text-gray-800 dark:text-gray-200">
                                    {{ $booking->total_pax }} Orang
                                </span>
                            </div>

                            <div class="flex justify-between items-baseline pt-3">
                                <div>
                                    <span class="text-xs font-bold uppercase tracking-wider text-gray-900 dark:text-white block">Total Tagihan</span>
                                    <span class="text-[11px] text-gray-400">Harga × Jumlah Peserta</span>
                                </div>
                                <span class="text-2xl font-extrabold text-indigo-600 dark:text-indigo-400">
                                    Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="pt-2">
                            <a
                                href="{{ route('booking.success', $booking->booking_code) }}"
                                target="_blank"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-xl text-xs font-semibold transition"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                Lihat Halaman Invoice Customer
                            </a>
                        </div>
                    </div>

                    <!-- Quick Navigation -->
                    <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-4 border border-gray-100 dark:border-gray-700 text-xs space-y-2">
                        <p class="font-bold text-gray-700 dark:text-gray-300">Navigasi Cepat:</p>
                        <a href="{{ route('bookings.index') }}" class="block text-indigo-600 dark:text-indigo-400 hover:underline">← Kembali ke Daftar Booking</a>
                        <a href="{{ route('bookings.create') }}" class="block text-indigo-600 dark:text-indigo-400 hover:underline">+ Buat Booking Baru</a>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
