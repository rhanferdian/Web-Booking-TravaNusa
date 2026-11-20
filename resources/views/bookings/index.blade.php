<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Kelola Booking') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ __('Daftar seluruh pesanan paket wisata customer.') }}
                </p>
            </div>
            <a href="{{ route('bookings.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                <svg class="w-5 h-5 me-1.5 -ms-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                {{ __('Tambah Booking Manual') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Alert -->
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" class="p-4 rounded-lg bg-green-50 dark:bg-green-950/50 border border-green-200 dark:border-green-800 flex items-center justify-between text-green-800 dark:text-green-200 transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" type="button" class="text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" class="p-4 rounded-lg bg-red-50 dark:bg-red-950/50 border border-red-200 dark:border-red-800 flex items-center justify-between text-red-800 dark:text-red-200 transition">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-600 dark:text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <span class="text-sm font-medium">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" type="button" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Stats Overview Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Booking</p>
                    <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-yellow-200 dark:border-yellow-900/50 bg-yellow-50/20">
                    <p class="text-xs font-medium text-yellow-700 dark:text-yellow-400 uppercase tracking-wider">Pending</p>
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">{{ $stats['pending'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-emerald-200 dark:border-emerald-900/50 bg-emerald-50/20">
                    <p class="text-xs font-medium text-emerald-700 dark:text-emerald-400 uppercase tracking-wider">Confirmed</p>
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 mt-1">{{ $stats['confirmed'] }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-4 rounded-xl shadow-sm border border-rose-200 dark:border-rose-900/50 bg-rose-50/20">
                    <p class="text-xs font-medium text-rose-700 dark:text-rose-400 uppercase tracking-wider">Canceled</p>
                    <p class="text-2xl font-bold text-rose-600 dark:text-rose-400 mt-1">{{ $stats['canceled'] }}</p>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="bg-white dark:bg-gray-800 p-4 sm:p-6 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700">
                <form method="GET" action="{{ route('bookings.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3">
                    <div class="sm:col-span-6 relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari kode booking, nama customer, no. telepon..."
                            class="w-full ps-10 pe-4 py-2 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg text-sm shadow-sm"
                        >
                    </div>

                    <div class="sm:col-span-3">
                        <select
                            name="status"
                            class="w-full py-2 ps-3 pe-8 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-lg text-sm shadow-sm"
                        >
                            <option value="">Semua Status</option>
                            <option value="pending" @selected(request('status') === 'pending')>Pending</option>
                            <option value="confirmed" @selected(request('status') === 'confirmed')>Confirmed</option>
                            <option value="canceled" @selected(request('status') === 'canceled')>Canceled</option>
                        </select>
                    </div>

                    <div class="sm:col-span-3 flex gap-2">
                        <button
                            type="submit"
                            class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-900 hover:bg-gray-800 dark:bg-gray-700 dark:hover:bg-gray-600 text-white text-sm font-medium rounded-lg transition"
                        >
                            Filter
                        </button>
                        @if (request()->hasAny(['search', 'status', 'tour_id']))
                            <a
                                href="{{ route('bookings.index') }}"
                                class="inline-flex items-center justify-center px-3 py-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition"
                                title="Reset Filter"
                            >
                                ✕
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-700/50">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-start font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Kode Booking</th>
                                <th scope="col" class="px-6 py-3.5 text-start font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Customer</th>
                                <th scope="col" class="px-6 py-3.5 text-start font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Paket Wisata</th>
                                <th scope="col" class="px-6 py-3.5 text-start font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Tgl Keberangkatan</th>
                                <th scope="col" class="px-6 py-3.5 text-center font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Peserta</th>
                                <th scope="col" class="px-6 py-3.5 text-start font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Total Tagihan</th>
                                <th scope="col" class="px-6 py-3.5 text-center font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Status</th>
                                <th scope="col" class="px-6 py-3.5 text-end font-semibold text-xs uppercase tracking-wider text-gray-500 dark:text-gray-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                            @forelse ($bookings as $booking)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/30 transition">
                                    {{-- Kode Booking --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('bookings.show', $booking) }}" class="font-mono font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                            {{ $booking->booking_code }}
                                        </a>
                                        <span class="block text-xs text-gray-400 mt-0.5">{{ $booking->created_at->format('d/m/Y H:i') }}</span>
                                    </td>

                                    {{-- Customer --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <p class="font-semibold text-gray-900 dark:text-gray-100">{{ $booking->customer_name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 font-mono">{{ $booking->customer_phone }}</p>
                                    </td>

                                    {{-- Paket Wisata --}}
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @if ($booking->tour)
                                                <img
                                                    src="{{ $booking->tour->thumbnail_url }}"
                                                    alt="{{ $booking->tour->title }}"
                                                    class="w-10 h-10 rounded-lg object-cover flex-shrink-0 border border-gray-200 dark:border-gray-700"
                                                    onerror="this.src='https://placehold.co/100x100?text=Tour'"
                                                >
                                                <div class="min-w-0">
                                                    <p class="font-medium text-gray-900 dark:text-gray-100 truncate max-w-xs">{{ $booking->tour->title }}</p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $booking->tour->location }}</p>
                                                </div>
                                            @else
                                                <span class="text-gray-400 italic">Tour dihapus</span>
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Tanggal Keberangkatan --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">
                                        {{ \Carbon\Carbon::parse($booking->travel_date)->locale('id')->isoFormat('D MMM Y') }}
                                    </td>

                                    {{-- Peserta --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-700 dark:text-gray-300 font-semibold">
                                        {{ $booking->total_pax }} pax
                                    </td>

                                    {{-- Total Tagihan --}}
                                    <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-900 dark:text-gray-100">
                                        Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                    </td>

                                    {{-- Status Badge --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        @if ($booking->status === 'confirmed')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 dark:bg-emerald-950 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                                Confirmed
                                            </span>
                                        @elseif ($booking->status === 'canceled')
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 dark:bg-rose-950 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                                Canceled
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-950 dark:text-yellow-300 border border-yellow-300 dark:border-yellow-800">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Aksi --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-end font-medium">
                                        <div class="inline-flex items-center gap-1">
                                            {{-- Detail --}}
                                            <a
                                                href="{{ route('bookings.show', $booking) }}"
                                                class="p-2 text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                                title="Lihat Detail"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>

                                            {{-- Edit --}}
                                            <a
                                                href="{{ route('bookings.edit', $booking) }}"
                                                class="p-2 text-gray-400 hover:text-amber-500 dark:hover:text-amber-400 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                                                title="Edit Booking"
                                            >
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>

                                            {{-- Hapus --}}
                                            <form
                                                action="{{ route('bookings.destroy', $booking) }}"
                                                method="POST"
                                                class="inline-block"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking {{ $booking->booking_code }}? Data yang dihapus tidak dapat dikembalikan.');"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="p-2 text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 rounded-lg hover:bg-red-50 dark:hover:bg-red-950/40 transition"
                                                    title="Hapus Booking"
                                                >
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="font-semibold text-gray-700 dark:text-gray-300">Belum ada data booking</p>
                                            <p class="text-xs text-gray-500 mt-1">Gunakan tombol "Tambah Booking Manual" untuk memasukkan data baru.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($bookings->hasPages())
                    <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
