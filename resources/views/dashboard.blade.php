<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Selamat datang kembali, <strong class="text-indigo-600 dark:text-indigo-400">{{ Auth::user()->name }}</strong>! Berikut ringkasan performa sistem tour & booking Anda.
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('tours.create') }}" class="inline-flex items-center justify-center px-3.5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Tour
                </a>
                <a href="{{ route('bookings.create') }}" class="inline-flex items-center justify-center px-3.5 py-2 bg-gray-900 hover:bg-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-xs font-semibold rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Booking
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- 1. STATS OVERVIEW CARDS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Total Tour --}}
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Total Paket Tour</span>
                            <span class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1 block">{{ $totalTour }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/60 text-blue-600 dark:text-blue-400 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs">
                        <span class="text-gray-500 dark:text-gray-400">Katalog destinasi aktif</span>
                        <a href="{{ route('tours.index') }}" class="font-semibold text-blue-600 dark:text-blue-400 hover:underline">Kelola Tour →</a>
                    </div>
                </div>

                {{-- Total Booking --}}
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Total Booking</span>
                            <span class="text-3xl font-extrabold text-gray-900 dark:text-white mt-1 block">{{ $totalBooking }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between text-xs">
                        <span class="text-gray-500 dark:text-gray-400">Seluruh pesanan masuk</span>
                        <a href="{{ route('bookings.index') }}" class="font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">Lihat Semua →</a>
                    </div>
                </div>

                {{-- Booking Pending --}}
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-yellow-200 dark:border-yellow-900/60 bg-yellow-50/20 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-yellow-700 dark:text-yellow-400 uppercase tracking-wider block">Booking Pending</span>
                            <span class="text-3xl font-extrabold text-yellow-600 dark:text-yellow-400 mt-1 block">{{ $totalBookingPending }}</span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-yellow-100 dark:bg-yellow-950/80 text-yellow-600 dark:text-yellow-400 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-yellow-100 dark:border-yellow-900/40 flex items-center justify-between text-xs">
                        <span class="text-yellow-800 dark:text-yellow-300">Menunggu konfirmasi</span>
                        <a href="{{ route('bookings.index', ['status' => 'pending']) }}" class="font-semibold text-yellow-700 dark:text-yellow-400 hover:underline">Proses →</a>
                    </div>
                </div>

                {{-- Total Pendapatan (Confirmed) --}}
                <div class="bg-white dark:bg-gray-800 p-5 rounded-2xl shadow-sm border border-emerald-200 dark:border-emerald-900/60 bg-emerald-50/20 relative overflow-hidden group">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-xs font-semibold text-emerald-700 dark:text-emerald-400 uppercase tracking-wider block">Total Pendapatan</span>
                            <span class="text-2xl font-extrabold text-emerald-600 dark:text-emerald-400 mt-1 block">
                                Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                            </span>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-950/80 text-emerald-600 dark:text-emerald-400 flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-t border-emerald-100 dark:border-emerald-900/40 flex items-center justify-between text-xs">
                        <span class="text-emerald-800 dark:text-emerald-300">{{ $totalBookingConfirmed }} booking confirmed</span>
                        <a href="{{ route('bookings.index', ['status' => 'confirmed']) }}" class="font-semibold text-emerald-700 dark:text-emerald-400 hover:underline">Rincian →</a>
                    </div>
                </div>

            </div>

            {{-- 2. STATUS BREAKDOWN MINI PILLS --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-yellow-400 animate-pulse"></span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Booking Pending</span>
                    </div>
                    <span class="text-base font-bold text-yellow-600 dark:text-yellow-400">{{ $totalBookingPending }}</span>
                </div>
                <div class="p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Booking Confirmed</span>
                    </div>
                    <span class="text-base font-bold text-emerald-600 dark:text-emerald-400">{{ $totalBookingConfirmed }}</span>
                </div>
                <div class="p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Booking Canceled</span>
                    </div>
                    <span class="text-base font-bold text-rose-600 dark:text-rose-400">{{ $totalBookingCanceled }}</span>
                </div>
            </div>

            {{-- 3. MAIN SECTION: RECENT BOOKINGS & LATEST TOURS --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- LEFT (2 COLS): 5 Booking Terbaru --}}
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Booking Terbaru</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5 pemesanan terakhir dari pelanggan.</p>
                        </div>
                        <a href="{{ route('bookings.index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                            Lihat Semua Booking →
                        </a>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                                <thead class="bg-gray-50 dark:bg-gray-700/50">
                                    <tr>
                                        <th scope="col" class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Kode Booking</th>
                                        <th scope="col" class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Customer</th>
                                        <th scope="col" class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Paket Wisata</th>
                                        <th scope="col" class="px-5 py-3 text-start text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Tagihan</th>
                                        <th scope="col" class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                                    @forelse ($recentBookings as $booking)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                            <td class="px-5 py-3.5 whitespace-nowrap">
                                                <a href="{{ route('bookings.show', $booking) }}" class="font-mono font-bold text-xs text-indigo-600 dark:text-indigo-400 hover:underline">
                                                    {{ $booking->booking_code }}
                                                </a>
                                                <span class="block text-[11px] text-gray-400">{{ $booking->created_at->diffForHumans() }}</span>
                                            </td>
                                            <td class="px-5 py-3.5 whitespace-nowrap">
                                                <span class="font-semibold text-gray-900 dark:text-gray-100 text-xs block">{{ $booking->customer_name }}</span>
                                                <span class="text-[11px] text-gray-500 dark:text-gray-400 font-mono">{{ $booking->customer_phone }}</span>
                                            </td>
                                            <td class="px-5 py-3.5">
                                                @if ($booking->tour)
                                                    <span class="text-xs font-medium text-gray-800 dark:text-gray-200 truncate block max-w-xs">{{ $booking->tour->title }}</span>
                                                    <span class="text-[11px] text-gray-400">{{ $booking->total_pax }} pax</span>
                                                @else
                                                    <span class="text-xs text-gray-400 italic">Tour dihapus</span>
                                                @endif
                                            </td>
                                            <td class="px-5 py-3.5 whitespace-nowrap text-xs font-bold text-gray-900 dark:text-gray-100">
                                                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                            </td>
                                            <td class="px-5 py-3.5 whitespace-nowrap text-center">
                                                @if ($booking->status === 'confirmed')
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200">
                                                        Confirmed
                                                    </span>
                                                @elseif ($booking->status === 'canceled')
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300 border border-rose-200">
                                                        Canceled
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[11px] font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-950 dark:text-yellow-300 border border-yellow-300">
                                                        Pending
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-xs text-gray-500 dark:text-gray-400">
                                                Belum ada booking yang masuk.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- RIGHT (1 COL): Paket Wisata & Quick Actions --}}
                <div class="space-y-6">

                    {{-- Paket Wisata Terbaru --}}
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <h3 class="text-sm font-bold text-gray-900 dark:text-white uppercase tracking-wider">Paket Tour Terbaru</h3>
                            <a href="{{ route('tours.index') }}" class="text-xs font-semibold text-indigo-600 dark:text-indigo-400 hover:underline">
                                Semua →
                            </a>
                        </div>

                        <div class="space-y-3">
                            @forelse ($latestTours as $tour)
                                <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700/40 transition">
                                    <img
                                        src="{{ $tour->thumbnail_url }}"
                                        alt="{{ $tour->title }}"
                                        class="w-12 h-12 rounded-lg object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700"
                                        onerror="this.src='https://placehold.co/100x100?text=Tour'"
                                    >
                                    <div class="min-w-0 flex-1">
                                        <h4 class="text-xs font-bold text-gray-900 dark:text-white truncate">{{ $tour->title }}</h4>
                                        <p class="text-[11px] text-gray-500 dark:text-gray-400">{{ $tour->location }}</p>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <span class="text-xs font-extrabold text-indigo-600 dark:text-indigo-400">{{ $tour->formatted_price }}</span>
                                            @if ($tour->is_published)
                                                <span class="text-[10px] bg-green-100 text-green-700 px-1.5 py-0.2 rounded font-medium">Published</span>
                                            @else
                                                <span class="text-[10px] bg-gray-100 text-gray-600 px-1.5 py-0.2 rounded font-medium">Draft</span>
                                            @endif
                                        </div>
                                    </div>
                                    <a href="{{ route('tours.show', $tour) }}" class="text-gray-400 hover:text-indigo-600 p-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @empty
                                <p class="text-xs text-gray-500 italic py-2">Belum ada paket wisata.</p>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
