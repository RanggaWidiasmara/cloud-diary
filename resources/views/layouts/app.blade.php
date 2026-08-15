<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Diary</title>
    <!-- JALUR CEPAT: Panggil Alpine.js langsung dari server luar (CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Vite buat nyambungin ke Tailwind -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Tambahin x-data Alpine.js untuk trigger buka-tutup sidebar di HP -->
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- Header Mobile (Hanya muncul di HP) -->
    <div class="md:hidden fixed w-full bg-white border-b border-slate-100 z-20 px-4 py-4 flex justify-between items-center shadow-sm">
        <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
            <span class="text-sky-500 text-2xl">☁️</span> Cloud Diary
        </h1>
        <!-- Tombol Hamburger -->
        <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-sky-500 focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
    </div>

    <!-- Overlay Gelap (Hanya muncul di HP/Tablet saat sidebar terbuka) -->
    <!-- Gua tambahin x-transition biar munculnya mulus (fade in/out) dan background pakai rgba biar anti-error -->
    <div x-show="sidebarOpen"
         x-transition.opacity.duration.300ms
         @click="sidebarOpen = false"
         class="fixed inset-0 z-30 md:hidden backdrop-blur-sm"
         style="background-color: rgba(15, 23, 42, 0.4); display: none;">
    </div>

    <!-- Sidebar Kiri (Responsive) -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-slate-100 flex flex-col justify-between h-full transform transition-transform duration-300 ease-in-out md:relative md:translate-x-0 shrink-0 shadow-xl md:shadow-none">
        <div>
            <!-- Header Logo (Muncul di Desktop, atau ditutup pas di HP) -->
            <div class="h-20 hidden md:flex items-center px-8 border-b border-slate-50 mb-4">
                <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                    <span class="text-sky-500 text-2xl">☁️</span> Cloud Diary
                </h1>
            </div>

            <!-- Header Sidebar Mobile -->
            <div class="h-20 md:hidden flex items-center justify-between px-6 border-b border-slate-50 mb-4">
                <span class="font-bold text-slate-700">Menu Navigasi</span>
                <button @click="sidebarOpen = false" class="text-slate-400 hover:text-red-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <!-- Menu Navigasi -->
            <nav class="px-4 flex flex-col gap-2">
                <a href="{{ route('home') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('home') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Home
                </a>

                <!-- LOGIKA AUTHENTICATION: Menu ini cuma muncul kalau udah Login -->
                @auth
                <a href="{{ route('profile.edit') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('profile.edit') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Profil
                </a>
                <a href="{{ route('history') }}" class="px-4 py-3 rounded-2xl transition {{ request()->routeIs('history') ? 'bg-sky-50 text-sky-600 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}">
                    Riwayat Curhat
                </a>
                @endauth
            </nav>
        </div>

        <!-- Bagian Bawah: Logic Auth vs Guest -->
        <div class="p-4 border-t border-slate-50">
            @auth
                <!-- Kalau Udah Login: Tombol Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-red-500 hover:bg-red-50 rounded-2xl transition font-semibold">
                        Logout
                    </button>
                </form>
            @else
                <!-- Kalau Guest: Tombol Login & Register -->
                <div class="flex flex-col gap-2">
                    <a href="{{ route('login') }}" class="w-full text-center px-4 py-3 text-sky-600 bg-sky-50 hover:bg-sky-100 rounded-2xl transition font-semibold">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="w-full text-center px-4 py-3 text-white bg-sky-500 hover:bg-sky-600 rounded-2xl transition font-semibold shadow-sm">
                        Daftar Gratis
                    </a>
                </div>
            @endauth
        </div>
    </aside>

    <!-- Konten Kanan Utama (Ditambahin pt-20 buat ngasih jarak dari Header Mobile) -->
    <main class="flex-1 overflow-y-auto md:pt-0 pt-20">
        @yield('content')
    </main>

</body>
</html>
