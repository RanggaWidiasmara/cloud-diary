@extends('layouts.app')

@section('content')
<div class="p-4 md:p-6 max-w-4xl mx-auto" x-data="{
    selectedEntries: null,
    selectedDateStr: '',
    showDetail(entries, dateStr) {
        this.selectedEntries = entries;
        this.selectedDateStr = dateStr;
        setTimeout(() => document.getElementById('detail-area').scrollIntoView({behavior: 'smooth', block: 'start'}), 100);
    }
}">

    <!-- Header Halaman -->
    <div class="mb-6 flex justify-between items-end">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Riwayat Awanmu ☁️</h2>
            <p class="text-sm text-slate-500 mt-1">Bulan {{ $date->translatedFormat('F Y') }}</p>
        </div>

        <!-- Tombol Navigasi Bulan -->
        <div class="flex gap-2">
            <a href="{{ route('history', ['month' => $date->copy()->subMonth()->month, 'year' => $date->copy()->subMonth()->year]) }}" class="px-3 py-1 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 text-sm font-medium transition">Bulan Lalu</a>
            @if(!($date->month == now()->month && $date->year == now()->year))
                <a href="{{ route('history') }}" class="px-3 py-1 bg-sky-50 text-sky-600 border border-sky-100 rounded-lg hover:bg-sky-100 text-sm font-medium transition">Bulan Ini</a>
            @endif
        </div>
    </div>

    <!-- KALENDER GRID -->
    <div class="bg-white rounded-3xl p-4 md:p-6 shadow-sm border border-slate-100 mb-8">
        <div class="grid grid-cols-7 gap-1 md:gap-2 text-center mb-2">

            <!-- Nama Hari -->
            @foreach(['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'] as $dayName)
                <div class="font-bold text-slate-400 text-xs md:text-sm py-2">{{ $dayName }}</div>
            @endforeach

            <!-- Kotak Kosong -->
            @for($i = 1; $i < $firstDayOfWeek; $i++)
                <div class="p-2 md:p-4 rounded-xl bg-slate-50/50"></div>
            @endfor

            <!-- Loop Tanggal -->
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $hasEntry = isset($entriesByDay[$day]);
                    $lastEntry = $hasEntry ? end($entriesByDay[$day]) : null;
                    $dateStr = $day . ' ' . $date->translatedFormat('F Y');

                    // Format data JSON yang aman
                    $mapped = [];
                    if ($hasEntry) {
                        $mapped = array_map(function($e) {
                            return [
                                'cloud_type' => $e->cloud_type,
                                'content' => $e->content,
                                'ai_suggestion' => $e->ai_suggestion,
                                'time' => \Carbon\Carbon::parse($e->created_at)->format('H:i')
                            ];
                        }, $entriesByDay[$day]);
                    }
                @endphp

                <!-- Kotak Tanggal (Dengan trik penyimpanan data di atribut dataset) -->
                <div @if($hasEntry) data-entries="{{ json_encode($mapped) }}" @endif
                     @click="{{ $hasEntry ? 'showDetail(JSON.parse($el.dataset.entries), \'' . $dateStr . '\')' : '' }}"
                     class="flex flex-col items-center justify-center p-2 md:p-3 rounded-xl border-2 transition duration-200 aspect-square relative
                     {{ $hasEntry ? 'bg-sky-50 border-sky-200 cursor-pointer hover:bg-sky-100 hover:scale-105 hover:shadow-md' : 'bg-white border-transparent text-slate-300' }}">

                    <span class="text-xs md:text-sm font-semibold mb-1 z-10 {{ $hasEntry ? 'text-sky-700' : '' }}">{{ $day }}</span>

                    @if($hasEntry)
                        <img src="{{ asset('images/clouds/' . $lastEntry->cloud_type . '.png') }}" class="w-6 h-6 md:w-10 md:h-10 object-cover drop-shadow-sm z-10" alt="{{ $lastEntry->cloud_type }}">

                        <!-- Indikator kalau dia curhat lebih dari 1 kali di hari itu -->
                        @if(count($entriesByDay[$day]) > 1)
                            <div class="absolute top-1 right-1 bg-red-400 text-white text-[9px] font-bold px-1.5 py-0.5 rounded-full z-20 shadow-sm">
                                {{ count($entriesByDay[$day]) }}
                            </div>
                        @endif
                    @else
                        <span class="text-[10px] md:text-xs opacity-0">-</span>
                    @endif
                </div>
            @endfor
        </div>
    </div>

    <!-- AREA DETAIL CURHATAN -->
    <div id="detail-area" x-show="selectedEntries" x-transition.opacity style="display: none;" class="bg-white rounded-3xl p-6 shadow-md border-2 border-sky-100 relative overflow-hidden mb-8">

        <!-- Header Detail -->
        <div class="flex justify-between items-center mb-6 pb-4 border-b border-slate-100">
            <h3 class="font-bold text-slate-700 text-lg">Catatan Tanggal <span x-text="selectedDateStr" class="text-sky-500"></span></h3>
            <button @click="selectedEntries = null" class="text-slate-400 hover:text-red-500 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Loop Semua Curhatan di Hari yang Dipilih -->
        <div class="space-y-6">
            <template x-for="(entry, index) in selectedEntries" :key="index">
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 relative">

                    <div class="flex items-start gap-4 mb-3">
                        <img :src="'{{ asset('images/clouds') }}/' + entry.cloud_type + '.png'" class="w-12 h-12 object-cover bg-white p-1.5 rounded-xl border border-slate-100 shadow-sm">
                        <div>
                            <p class="text-md font-bold text-slate-800 uppercase" x-text="entry.cloud_type"></p>
                            <p class="text-xs font-semibold text-slate-400" x-text="'Pukul ' + entry.time"></p>
                        </div>
                    </div>

                    <p class="text-sm text-slate-600 mb-4 italic pl-1 leading-relaxed" x-text="'&quot;' + entry.content + '&quot;'"></p>

                    <div class="p-3 bg-indigo-50/70 rounded-xl border border-indigo-100" x-show="entry.ai_suggestion">
                        <div class="flex items-center mb-1">
                            <span class="text-indigo-400 mr-2 text-xs">✨</span>
                            <span class="font-bold text-indigo-700 text-[10px] uppercase tracking-wider">Saran Awan</span>
                        </div>
                        <p class="text-xs text-indigo-800 leading-relaxed" x-text="entry.ai_suggestion"></p>
                    </div>
                </div>
            </template>
        </div>

    </div>
</div>
@endsection
