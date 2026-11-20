<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('tours.index') }}" class="p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition" title="Kembali ke Daftar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Detail Tour') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">
                        {{ __('Informasi lengkap paket wisata.') }}
                    </p>
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center gap-2">
                <a href="{{ route('tours.edit', $tour) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium rounded-lg shadow-sm transition">
                    <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    {{ __('Edit Tour') }}
                </a>

                <form
                    action="{{ route('tours.destroy', $tour) }}"
                    method="POST"
                    class="inline-block"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket tour {{ addslashes($tour->title) }}?');"
                >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                        <svg class="w-4 h-4 me-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        {{ __('Hapus') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <!-- Thumbnail Cover -->
                <div class="relative w-full h-72 sm:h-96 bg-gray-100 dark:bg-gray-900 overflow-hidden">
                    <img
                        src="{{ $tour->thumbnail_url }}"
                        alt="{{ $tour->title }}"
                        class="w-full h-full object-cover"
                    >
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>

                    <!-- Badges overlay -->
                    <div class="absolute top-4 start-4 flex items-center gap-2">
                        @if ($tour->is_published)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-500 text-white shadow-md">
                                ● Published
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-600 text-white shadow-md">
                                Draft
                            </span>
                        @endif

                        @if ($tour->is_popular)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-500 text-white shadow-md">
                                ★ Popular Tour
                            </span>
                        @endif
                    </div>

                    <!-- Title & price overlay -->
                    <div class="absolute bottom-6 start-6 end-6 text-white">
                        <span class="text-sm font-medium tracking-wide uppercase text-indigo-300">
                            {{ $tour->location }}
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-bold mt-1">
                            {{ $tour->title }}
                        </h1>
                    </div>
                </div>

                <!-- Info Grid -->
                <div class="p-6 sm:p-8 space-y-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/60 border border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Harga Paket</span>
                            <span class="text-xl font-bold text-indigo-600 dark:text-indigo-400 mt-1 block">
                                {{ $tour->formatted_price }}
                            </span>
                            <span class="text-xs text-gray-400 dark:text-gray-500">per orang / tiket</span>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/60 border border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Durasi Wisata</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white mt-1 block">
                                {{ $tour->duration }}
                            </span>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/60 border border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Lokasi</span>
                            <span class="text-lg font-semibold text-gray-900 dark:text-white mt-1 block truncate" title="{{ $tour->location }}">
                                {{ $tour->location }}
                            </span>
                        </div>

                        <div class="p-4 rounded-xl bg-gray-50 dark:bg-gray-900/60 border border-gray-100 dark:border-gray-700">
                            <span class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider block">Status Publikasi</span>
                            <span class="text-lg font-semibold {{ $tour->is_published ? 'text-green-600 dark:text-green-400' : 'text-gray-600 dark:text-gray-400' }} mt-1 block">
                                {{ $tour->is_published ? 'Aktif (Published)' : 'Draft' }}
                            </span>
                        </div>
                    </div>

                    <!-- Meta Details -->
                    <div class="border-t border-gray-100 dark:border-gray-700 pt-6">
                        <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                            Informasi Sistem & Slug
                        </h3>
                        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                            <div>
                                <dt class="text-gray-500 dark:text-gray-400">Slug URL</dt>
                                <dd class="mt-0.5 font-mono text-gray-900 dark:text-white bg-gray-100 dark:bg-gray-900 px-2.5 py-1 rounded-md w-fit">
                                    {{ $tour->slug }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-gray-500 dark:text-gray-400">Path File Thumbnail</dt>
                                <dd class="mt-0.5 font-mono text-xs text-gray-700 dark:text-gray-300 truncate" title="{{ $tour->thumbnail }}">
                                    {{ $tour->thumbnail }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-gray-500 dark:text-gray-400">Dibuat Pada</dt>
                                <dd class="mt-0.5 text-gray-900 dark:text-white">
                                    {{ $tour->created_at?->format('d M Y, H:i') ?? '-' }}
                                </dd>
                            </div>
                            <div>
                                <dt class="text-gray-500 dark:text-gray-400">Terakhir Diperbarui</dt>
                                <dd class="mt-0.5 text-gray-900 dark:text-white">
                                    {{ $tour->updated_at?->format('d M Y, H:i') ?? '-' }}
                                </dd>
                            </div>
                        </dl>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
