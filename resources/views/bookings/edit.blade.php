<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('bookings.index') }}" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" title="Kembali">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Edit Booking') }} <span class="text-indigo-600 dark:text-indigo-400 font-mono">#{{ $booking->booking_code }}</span>
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                    {{ __('Perbarui data pemesanan customer.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8">

                @php
                    $toursData = $tours->mapWithKeys(function ($tour) {
                        return [$tour->id => [
                            'price' => $tour->price,
                            'title' => $tour->title,
                            'location' => $tour->location,
                        ]];
                    });
                @endphp

                <form
                    action="{{ route('bookings.update', $booking) }}"
                    method="POST"
                    x-data="{
                        tours: {{ json_encode($toursData) }},
                        selectedTourId: '{{ old('tour_id', $booking->tour_id) }}',
                        pax: {{ old('total_pax', $booking->total_pax) }},
                        get currentPrice() {
                            return this.tours[this.selectedTourId] ? this.tours[this.selectedTourId].price : 0;
                        },
                        get totalAmount() {
                            return this.currentPrice * (this.pax || 0);
                        },
                        get formattedTotal() {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(this.totalAmount);
                        },
                        get formattedPrice() {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(this.currentPrice);
                        }
                    }"
                    class="space-y-6"
                >
                    @csrf
                    @method('PUT')

                    <!-- Info Kode Booking (Readonly Info) -->
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg flex items-center justify-between border border-gray-100 dark:border-gray-700">
                        <div>
                            <span class="text-xs uppercase font-semibold text-gray-400">Kode Booking (Permanen)</span>
                            <p class="text-lg font-mono font-bold text-gray-900 dark:text-gray-100">{{ $booking->booking_code }}</p>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            Dibuat: {{ $booking->created_at->format('d M Y H:i') }}
                        </span>
                    </div>

                    <!-- Pilih Tour -->
                    <div>
                        <x-input-label for="tour_id" :value="__('Paket Wisata *')" />
                        <select
                            id="tour_id"
                            name="tour_id"
                            x-model="selectedTourId"
                            required
                            class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm"
                        >
                            @foreach ($tours as $tour)
                                <option value="{{ $tour->id }}" @selected(old('tour_id', $booking->tour_id) == $tour->id)>
                                    {{ $tour->title }} — {{ $tour->location }} (Rp {{ number_format($tour->price, 0, ',', '.') }}/pax)
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('tour_id')" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nama Customer -->
                        <div>
                            <x-input-label for="customer_name" :value="__('Nama Lengkap Customer *')" />
                            <x-text-input
                                id="customer_name"
                                name="customer_name"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('customer_name', $booking->customer_name)"
                                required
                            />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        <!-- Nomor Telepon Customer -->
                        <div>
                            <x-input-label for="customer_phone" :value="__('Nomor Telepon / WhatsApp *')" />
                            <x-text-input
                                id="customer_phone"
                                name="customer_phone"
                                type="tel"
                                class="mt-1 block w-full"
                                :value="old('customer_phone', $booking->customer_phone)"
                                required
                            />
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <!-- Tanggal Keberangkatan -->
                        <div>
                            <x-input-label for="travel_date" :value="__('Tanggal Keberangkatan *')" />
                            <x-text-input
                                id="travel_date"
                                name="travel_date"
                                type="date"
                                class="mt-1 block w-full"
                                :value="old('travel_date', \Carbon\Carbon::parse($booking->travel_date)->format('Y-m-d'))"
                                required
                            />
                            <x-input-error :messages="$errors->get('travel_date')" class="mt-2" />
                        </div>

                        <!-- Jumlah Peserta -->
                        <div>
                            <x-input-label for="total_pax" :value="__('Jumlah Peserta (Pax) *')" />
                            <x-text-input
                                id="total_pax"
                                name="total_pax"
                                type="number"
                                min="1"
                                max="50"
                                x-model.number="pax"
                                class="mt-1 block w-full"
                                required
                            />
                            <x-input-error :messages="$errors->get('total_pax')" class="mt-2" />
                        </div>

                        <!-- Status Booking -->
                        <div>
                            <x-input-label for="status" :value="__('Status Booking *')" />
                            <select
                                id="status"
                                name="status"
                                required
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm text-sm"
                            >
                                <option value="pending" @selected(old('status', $booking->status) === 'pending')>Pending (Menunggu)</option>
                                <option value="confirmed" @selected(old('status', $booking->status) === 'confirmed')>Confirmed (Dikonfirmasi)</option>
                                <option value="canceled" @selected(old('status', $booking->status) === 'canceled')>Canceled (Dibatalkan)</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Live Kalkulasi Tagihan Box -->
                    <div class="bg-indigo-50 dark:bg-indigo-950/40 border border-indigo-200 dark:border-indigo-800 rounded-xl p-5">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                            <div>
                                <h3 class="text-xs font-bold uppercase tracking-wider text-indigo-900 dark:text-indigo-300">Total Tagihan Hasil Perhitungan</h3>
                                <p class="text-xs text-indigo-700 dark:text-indigo-400 mt-0.5">
                                    Rumus: <span x-text="formattedPrice"></span> × <span x-text="pax"></span> pax
                                </p>
                            </div>
                            <div class="text-start sm:text-end">
                                <span class="text-2xl font-extrabold text-indigo-700 dark:text-indigo-300" x-text="formattedTotal"></span>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <a href="{{ route('bookings.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 rounded-lg text-sm font-medium transition">
                            {{ __('Batal') }}
                        </a>
                        <x-primary-button>
                            {{ __('Simpan Perubahan') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
