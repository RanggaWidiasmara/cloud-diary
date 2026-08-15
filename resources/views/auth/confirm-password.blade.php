<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Konfirmasi Keamanan 🔒</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Area ini dilindungi awan tebal. Masukkan passwordmu sekali lagi untuk memastikan ini benar-benar kamu.
        </p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-6 text-left">
            <label for="password" class="block text-sm font-medium text-slate-700 mb-1">Password</label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="w-full rounded-xl border-slate-200 focus:border-sky-500 focus:ring focus:ring-sky-200 focus:ring-opacity-50 text-sm text-slate-700 p-3 shadow-sm transition">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div class="flex justify-end">
            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5">
                Konfirmasi
            </button>
        </div>
    </form>
</x-guest-layout>
