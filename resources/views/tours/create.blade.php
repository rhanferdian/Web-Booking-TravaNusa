<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('tours.index') }}" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" title="Kembali">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
            </a>
            <div>
                <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Tambah Tour Baru') }}
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                    {{ __('Isi formulir di bawah ini untuk menambahkan destinasi paket wisata baru.') }}
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 sm:p-8">
                <form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Judul Tour *')" />
                        <x-text-input
                            id="title"
                            name="title"
                            type="text"
                            class="mt-1 block w-full"
                            :value="old('title')"
                            placeholder="Contoh: Eksplorasi Nusa Penida 3 Hari 2 Malam"
                            required
                            autofocus
                        />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <!-- Slug -->
                    <div>
                        <x-input-label for="slug" :value="__('Slug (Opsional)')" />
                        <x-text-input
                            id="slug"
                            name="slug"
                            type="text"
                            class="mt-1 block w-full font-mono text-sm"
                            :value="old('slug')"
                            placeholder="Biarkan kosong untuk digenerate otomatis dari judul"
                        />
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Digunakan untuk URL ramah SEO. Contoh: <span class="font-mono">eksplorasi-nusa-penida-3d2n</span>
                        </p>
                        <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Location -->
                        <div>
                            <x-input-label for="location" :value="__('Lokasi Destinasi *')" />
                            <x-text-input
                                id="location"
                                name="location"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('location')"
                                placeholder="Contoh: Nusa Penida, Bali"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('location')" />
                        </div>

                        <!-- Duration -->
                        <div>
                            <x-input-label for="duration" :value="__('Durasi Wisata *')" />
                            <x-text-input
                                id="duration"
                                name="duration"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('duration')"
                                placeholder="Contoh: 3 Hari 2 Malam / 1 Hari Penuh"
                                required
                            />
                            <x-input-error class="mt-2" :messages="$errors->get('duration')" />
                        </div>
                    </div>

                    <!-- Price -->
                    <div>
                        <x-input-label for="price" :value="__('Harga (IDR) *')" />
                        <div class="relative mt-1 rounded-md shadow-sm">
                            <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3 text-gray-500 dark:text-gray-400 text-sm font-semibold">
                                Rp
                            </div>
                            <x-text-input
                                id="price"
                                name="price"
                                type="number"
                                min="0"
                                step="1000"
                                class="block w-full ps-10"
                                :value="old('price')"
                                placeholder="1500000"
                                required
                            />
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                            Masukkan nominal harga per orang tanpa titik atau koma (contoh: 1500000).
                        </p>
                        <x-input-error class="mt-2" :messages="$errors->get('price')" />
                    </div>

                    <!-- Thumbnail with Live Preview -->
                    <div x-data="{ previewUrl: null }">
                        <x-input-label for="thumbnail" :value="__('Foto Thumbnail *')" />
                        
                        <div class="mt-2 flex flex-col sm:flex-row items-start sm:items-center gap-4">
                            <!-- Preview Box -->
                            <div class="w-36 h-24 rounded-lg border-2 border-dashed border-gray-300 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 flex items-center justify-center overflow-hidden shrink-0">
                                <template x-if="previewUrl">
                                    <img :src="previewUrl" alt="Preview Thumbnail" class="w-full h-full object-cover">
                                </template>
                                <template x-if="!previewUrl">
                                    <div class="text-center p-2 text-gray-400 dark:text-gray-500">
                                        <svg class="w-8 h-8 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-xs mt-1 block">Preview</span>
                                    </div>
                                </template>
                            </div>

                            <div class="flex-1 w-full">
                                <input
                                    id="thumbnail"
                                    name="thumbnail"
                                    type="file"
                                    accept="image/png,image/jpeg,image/jpg,image/webp"
                                    class="block w-full text-sm text-gray-500 dark:text-gray-400
                                           file:me-4 file:py-2 file:px-4
                                           file:rounded-lg file:border-0
                                           file:text-sm file:font-semibold
                                           file:bg-indigo-50 file:text-indigo-700
                                           dark:file:bg-indigo-950 dark:file:text-indigo-300
                                           hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900
                                           cursor-pointer"
                                    @change="const file = $event.target.files[0]; if (file) { previewUrl = URL.createObjectURL(file) }"
                                    required
                                >
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Format: JPG, JPEG, PNG, WEBP. Maksimal 3MB. Disarankan rasio 16:9 atau 4:3.
                                </p>
                            </div>
                        </div>
                        <x-input-error class="mt-2" :messages="$errors->get('thumbnail')" />
                    </div>

                    <!-- Status Options -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-700 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition">
                            <input
                                type="checkbox"
                                name="is_published"
                                value="1"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 mt-1"
                                @checked(old('is_published', true))
                            >
                            <div>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100 block">Publikasikan Langsung</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 block mt-0.5">Tour akan langsung terlihat oleh pengguna publik jika dicentang.</span>
                            </div>
                        </label>

                        <label class="flex items-start gap-3 p-3 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-900/50 hover:bg-gray-50 dark:hover:bg-gray-900 cursor-pointer transition">
                            <input
                                type="checkbox"
                                name="is_popular"
                                value="1"
                                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-amber-500 shadow-sm focus:ring-amber-500 mt-1"
                                @checked(old('is_popular', false))
                            >
                            <div>
                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100 block">Tandai Populer (Featured)</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 block mt-0.5">Akan mendapatkan badge populer dan diprioritaskan di rekomendasi.</span>
                            </div>
                        </label>
                    </div>

                    <!-- Form Actions -->
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex items-center justify-end gap-3">
                        <a href="{{ route('tours.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition">
                            {{ __('Batal') }}
                        </a>
                        <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800">
                            {{ __('Simpan Tour') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
