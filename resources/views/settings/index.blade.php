<x-app-layout>
    <div class="py-8 px-6 max-w-3xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-white">Pengaturan Sistem</h1>
            <p class="text-sm text-slate-400">Kelola nomor WhatsApp resmi yang terhubung ke halaman depan dan invoice booking.</p>
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-6 shadow-lg">
            <form action="{{ route('settings.update') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-slate-300 mb-2">
                        Nomor WhatsApp Admin (Format: 628xxxxxxxx)
                    </label>
                    <input
                        type="text"
                        id="whatsapp_number"
                        name="whatsapp_number"
                        value="{{ old('whatsapp_number', $whatsappNumber) }}"
                        placeholder="6281234567890"
                        class="w-full rounded-xl bg-slate-950 border border-slate-700 text-white px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500"
                        required
                    >
                    @error('whatsapp_number')
                        <p class="mt-1 text-xs text-rose-400">{{ $message }}</p>
                    @enderror
                    <p class="mt-2 text-xs text-slate-400">
                        Gunakan kode negara <code class="text-slate-300">62</code> tanpa tanda <code class="text-slate-300">+</code> atau spasi. Link aktif saat ini:
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="text-blue-400 hover:underline">
                            https://wa.me/{{ $whatsappNumber }}
                        </a>
                    </p>
                </div>

                <div class="pt-2 flex justify-end">
                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-sm font-semibold transition"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>