<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cloud Diary - gurubk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Tambahkan baris ini di dalam <head> -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="flex h-screen bg-slate-50 font-sans antialiased">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col hidden md:flex shrink-0">
        <!-- Tautan ke Halaman Edit Profil -->
        <a href="{{ route('gurubk.profil') }}" class="flex items-center gap-3 text-left hover:bg-slate-50 p-4 border-b border-slate-200 transition">
            <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 font-bold shrink-0">BR</div>
            <div class="flex-1">
                <p class="text-sm font-bold text-slate-800">Bu Rina</p>
                <p class="text-xs text-slate-500">Guru BK</p>
            </div>
        </a>
        <nav class="flex-1 overflow-y-auto py-4">
            <ul class="space-y-1">
                <li>
                    <a href="{{ route('gurubk.dashboard') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.dashboard') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">🏠</span> Dashboard
                    </a>
                </li>
                <li class="px-6 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4">Monitoring</li>
                <li>
                    <a href="{{ route('gurubk.ringkasan') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.ringkasan') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">📈</span> Ringkasan Emosi
                    </a>
                </li>
                <li>
                    <a href="{{ route('gurubk.triage') }}" class="flex items-center px-6 py-2.5 transition whitespace-nowrap {{ request()->routeIs('gurubk.triage') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">⚠️</span> Triage & Rekomendasi
                    </a>
                </li>
                <li>
                    <a href="{{ route('gurubk.riwayat') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.riwayat') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">📋</span> Riwayat Tindakan
                    </a>
                </li>
                <li>
                    <button onclick="document.getElementById('submenu-siswa').classList.toggle('hidden')" class="w-full flex items-center justify-between px-6 py-2.5 text-slate-600 hover:bg-slate-50 transition focus:outline-none">
                        <div class="flex items-center {{ request()->is('gurubk/siswa/*') ? 'text-sky-600 font-medium' : '' }}">
                            <span class="mr-3">👥</span> Data Siswa
                        </div>
                        <span class="text-xs text-slate-400">▼</span>
                    </button>
                    
                    <!-- Isi Sub-menu Kelas -->
                    <ul id="submenu-siswa" class="bg-slate-50/50 py-1 space-y-1 border-y border-slate-100 {{ request()->is('gurubk/siswa/*') ? '' : 'hidden' }}">
                        <li>
                            <a href="{{ route('gurubk.siswa', ['tingkat' => '10']) }}" class="flex items-center px-6 py-2 text-sm transition pl-12 border-l-2 {{ request()->is('gurubk/siswa/10') ? 'text-sky-600 font-semibold border-sky-500 bg-sky-50' : 'text-slate-500 border-transparent hover:text-sky-600 hover:bg-sky-50 hover:border-sky-500' }}">
                                Kelas 10
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gurubk.siswa', ['tingkat' => '11']) }}" class="flex items-center px-6 py-2 text-sm transition pl-12 border-l-2 {{ request()->is('gurubk/siswa/11') ? 'text-sky-600 font-semibold border-sky-500 bg-sky-50' : 'text-slate-500 border-transparent hover:text-sky-600 hover:bg-sky-50 hover:border-sky-500' }}">
                                Kelas 11
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('gurubk.siswa', ['tingkat' => '12']) }}" class="flex items-center px-6 py-2 text-sm transition pl-12 border-l-2 {{ request()->is('gurubk/siswa/12') ? 'text-sky-600 font-semibold border-sky-500 bg-sky-50' : 'text-slate-500 border-transparent hover:text-sky-600 hover:bg-sky-50 hover:border-sky-500' }}">
                                Kelas 12
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="px-6 py-2 text-xs font-semibold text-slate-400 uppercase tracking-wider mt-4">Lainnya</li>
                <li>
                    <a href="{{ route('gurubk.pengguna') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.pengguna') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">👤</span> Akun Pengguna
                    </a>
                </li>
                <li>
                    <a href="{{ route('gurubk.angkatan') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.angkatan') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">🎓</span> Histori Angkatan
                    </a>
                </li>
                <li>
                    <a href="{{ route('gurubk.pengaturan') }}" class="flex items-center px-6 py-2.5 transition {{ request()->routeIs('gurubk.pengaturan') ? 'bg-sky-50 text-sky-600 border-r-4 border-sky-500 font-medium' : 'text-slate-600 hover:bg-slate-50' }}">
                        <span class="mr-3">⚙️</span> Pengaturan
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t border-slate-200">
            <a href="#" class="flex items-center text-slate-500 hover:text-red-500 transition">
                <span class="mr-3">🚪</span> Logout
            </a>
        </div>
    </aside>

    <!-- AREA UTAMA -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <header class="h-16 bg-white border-b border-slate-200 flex items-center justify-between px-6 z-40 relative">
            <button class="md:hidden text-slate-500">☰</button>
            
            <!-- Bagian Kanan Header -->
            <div class="flex items-center gap-5 ml-auto">
                
                <!-- Wrapper Notifikasi dengan Relative Positioning -->
                <div class="relative">
                    <!-- Tombol Lonceng -->
                    <button id="notif-btn" onclick="document.getElementById('notif-dropdown').classList.toggle('hidden')" class="relative p-2 text-slate-400 hover:text-slate-600 transition focus:outline-none flex items-center justify-center">
                        <span class="text-2xl">🔔</span>
                        <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center border-2 border-white">3</span>
                    </button>

                    <!-- Isi Dropdown Notifikasi (Tersembunyi secara default) -->
                    <div id="notif-dropdown" class="hidden absolute right-0 mt-2 w-80 bg-white border border-slate-200 rounded-2xl shadow-xl overflow-hidden z-50">
                        <!-- Header Notifikasi -->
                        <div class="px-4 py-3 border-b border-slate-100 bg-slate-50 flex justify-between items-center">
                            <h3 class="font-bold text-slate-800 text-sm">Notifikasi</h3>
                            <button class="text-xs text-sky-500 hover:text-sky-600 font-medium">Tandai dibaca</button>
                        </div>
                        
                        <!-- Daftar Notifikasi -->
                        <div class="max-h-80 overflow-y-auto divide-y divide-slate-100">
                            <!-- Item 1 (Peringatan Triage) -->
                            <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition bg-sky-50/30">
                                <div class="flex items-start gap-3">
                                    <span class="text-red-500 text-lg mt-0.5">⚠️</span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Peringatan Triage: Aulia Putri</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Siswa menunjukkan indikasi depresi tinggi hari ini.</p>
                                        <span class="text-[10px] text-slate-400 mt-1 block font-medium">10 menit yang lalu</span>
                                    </div>
                                </div>
                            </a>
                            
                            <!-- Item 2 (Sistem) -->
                            <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition">
                                <div class="flex items-start gap-3">
                                    <span class="text-sky-500 text-lg mt-0.5">📝</span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Laporan Emosi Siap</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Ringkasan analitik Kelas 10 bulan ini sudah dapat diunduh.</p>
                                        <span class="text-[10px] text-slate-400 mt-1 block font-medium">2 jam yang lalu</span>
                                    </div>
                                </div>
                            </a>

                            <!-- Item 3 (Info) -->
                            <a href="#" class="block px-4 py-3 hover:bg-slate-50 transition">
                                <div class="flex items-start gap-3">
                                    <span class="text-emerald-500 text-lg mt-0.5">👤</span>
                                    <div>
                                        <p class="text-sm font-semibold text-slate-800">Pengguna Baru</p>
                                        <p class="text-xs text-slate-500 mt-0.5">Bima Arya (Kelas 10) berhasil login ke Cloud Diary.</p>
                                        <span class="text-[10px] text-slate-400 mt-1 block font-medium">Kemarin</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Footer Notifikasi -->
                        <div class="px-4 py-2.5 border-t border-slate-100 text-center bg-slate-50 hover:bg-slate-100 transition">
                            <a href="#" class="text-xs font-semibold text-sky-500 hover:text-sky-600 block">Lihat Semua Notifikasi</a>
                        </div>
                    </div>
                </div>

                <!-- Nama Sekolah (Teks Statis, Tanpa Dropdown) -->
                <div class="text-sm font-bold text-slate-700 bg-slate-100 px-4 py-1.5 rounded-lg border border-slate-200">
                    SMA XYZ
                </div>

            </div>
        </header>

        <!-- KONTEN TENGAH -->
        <div class="flex-1 overflow-y-auto p-6">
            @yield('content')
        </div>
    </main>
<!-- Script Interaksi Global -->
    <script>
        document.addEventListener('click', function(event) {
            const notifDropdown = document.getElementById('notif-dropdown');
            const notifBtn = document.getElementById('notif-btn');
            
            // Jika dropdown sedang terbuka dan klik TIDAK terjadi di tombol atau di dalam dropdown itu sendiri
            if (notifDropdown && notifBtn) {
                if (!notifBtn.contains(event.target) && !notifDropdown.contains(event.target)) {
                    notifDropdown.classList.add('hidden'); // Sembunyikan notifikasi
                }
            }
        });
    </script>
</body>
</html>