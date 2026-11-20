<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-xl font-bold text-white">Portal Login Admin</h1>
        <p class="mt-1 text-sm text-gray-400">Masuk untuk mengelola paket wisata dan data booking.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-1.5">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="admin@travanusa.co.id"
                required
                autofocus
                autocomplete="username"
                class="w-full rounded-xl bg-gray-900 border border-gray-700 text-white placeholder-gray-500 px-4 py-2.5 text-sm focus:border-indigo-500 focus:ring-indigo-500"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password with Show/Hide Toggle -->
        <div x-data="{ showPassword: false }">
            <div class="flex items-center justify-between mb-1.5">
                <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs text-indigo-400 hover:text-indigo-300 transition">
                        Lupa password?
                    </a>
                @endif
            </div>

            <div class="relative">
                <input
                    id="password"
                    :type="showPassword ? 'text' : 'password'"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                    class="w-full rounded-xl bg-gray-900 border border-gray-700 text-white placeholder-gray-500 px-4 py-2.5 pr-11 text-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <button
                    type="button"
                    @click="showPassword = !showPassword"
                    aria-label="Tampilkan atau sembunyikan password"
                    class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-gray-400 hover:text-gray-200 transition"
                >
                    <svg x-show="!showPassword" width="18" height="18" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" style="display: none;" width="18" height="18" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                name="remember"
                class="rounded bg-gray-900 border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 focus:ring-offset-gray-800"
            >
            <label for="remember_me" class="ms-2 text-sm text-gray-400 select-none cursor-pointer">
                Ingat sesi saya
            </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-1">
            <button
                type="submit"
                class="w-full flex justify-center items-center py-3 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white text-sm font-semibold shadow-lg shadow-indigo-500/25 transition"
            >
                Masuk ke Dashboard
            </button>
        </div>
    </form>
</x-guest-layout>