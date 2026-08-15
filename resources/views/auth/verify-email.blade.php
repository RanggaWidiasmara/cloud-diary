<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Cek Kotak Masukmu! 📧</h2>
        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
            Terima kasih sudah bergabung! Sebelum mulai curhat, tolong klik tautan verifikasi yang baru saja kami kirim ke emailmu. Kalau belum masuk, kami bisa mengirimkannya lagi.
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-sm font-medium text-green-600 text-center shadow-sm">
            Tautan verifikasi baru telah dikirim ke alamat emailmu! ✨
        </div>
    @endif

    <div class="mt-4 flex flex-col gap-3">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white font-semibold py-3 px-4 rounded-xl transition duration-200 shadow-md shadow-sky-200 hover:shadow-lg hover:-translate-y-0.5">
                Kirim Ulang Tautan Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full bg-white border-2 border-slate-200 hover:border-slate-300 text-slate-600 font-semibold py-3 px-4 rounded-xl transition duration-200 hover:bg-slate-50 shadow-sm">
                Keluar Akun
            </button>
        </form>
    </div>
</x-guest-layout>
