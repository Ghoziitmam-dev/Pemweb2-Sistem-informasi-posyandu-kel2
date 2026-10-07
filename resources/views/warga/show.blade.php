<x-layouts.panel title="Detail Warga">

@php
    $labels = [
        'balita' => 'Balita',
        'ibu_hamil' => 'Ibu Hamil',
        'remaja' => 'Remaja',
        'dewasa' => 'Dewasa',
        'lansia' => 'Lansia',
    ];
@endphp

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                Detail Warga
            </h1>
            <p class="mt-1 text-sm font-semibold capitalize text-[#3C5A52]">
                {{ $warga->nama }}
            </p>
        </div>

        <a href="{{ route('warga.index') }}" class="btn-secondary">
            &larr; Kembali
        </a>
    </div>

    @if (session('success'))
        <div class="mb-6 flex items-center justify-between rounded-xl border border-[#8EB69B] bg-[#DAF1DE] px-4 py-3 text-sm font-semibold text-[#051F20]">
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-[#DAF1DE] bg-white shadow-sm">
        <div class="grid gap-px bg-[#DAF1DE]/40 text-sm md:grid-cols-2">

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">NIK</dt>
                <dd class="mt-1 font-mono font-bold text-[#051F20] text-base">{{ $warga->nik }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Nama Lengkap</dt>
                <dd class="mt-1 font-bold text-[#051F20] text-base">{{ $warga->nama }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Tanggal Lahir & Usia</dt>
                <dd class="mt-1 font-semibold text-[#163832]">{{ $warga->tanggal_lahir->format('d/m/Y') }} ({{ $warga->umur }} tahun)</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Jenis Kelamin</dt>
                <dd class="mt-1 font-semibold text-[#163832]">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
            </div>

            <div class="bg-white px-5 py-4 md:col-span-2">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Alamat Domisili</dt>
                <dd class="mt-1 font-semibold text-[#051F20] leading-relaxed">{{ $warga->alamat }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">RT / RW</dt>
                <dd class="mt-1 font-bold text-[#163832]">{{ $warga->rt_rw }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Kategori Warga</dt>
                <dd class="mt-1.5">
                    <span class="badge-mint">
                        {{ $labels[$warga->kategori] ?? ucfirst($warga->kategori) }}
                    </span>
                </dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">Nama Wali</dt>
                <dd class="mt-1 font-semibold text-[#163832]">{{ $warga->nama_wali ?? '-' }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">No. Telepon / HP</dt>
                <dd class="mt-1 font-semibold text-[#163832]">{{ $warga->no_hp ?? '-' }}</dd>
            </div>

        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-3">
        <a href="{{ route('warga.edit', $warga) }}" class="btn-primary">
            Edit Data Warga
        </a>
    </div>

    {{-- Riwayat Kegiatan & Pemeriksaan --}}
    <div class="mt-8 space-y-8">
        {{-- Riwayat Kegiatan --}}
        <div>
            <h2 class="mb-4 text-xl font-extrabold text-[#051F20] border-b border-[#DAF1DE] pb-2">Riwayat Kegiatan</h2>
            @php
                $kegiatans = $warga->pemeriksaans->map(function($p) {
                    return [
                        'nama' => $p->jadwal?->kegiatan?->judul ?? $p->jadwal?->nama ?? 'Kegiatan Posyandu',
                        'tanggal' => $p->tanggal ?? $p->jadwal?->tanggal,
                    ];
                })->unique(function ($item) {
                    return $item['nama'] . $item['tanggal'];
                });
            @endphp
            
            @if($kegiatans->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-8 text-center text-sm font-medium text-slate-500">
                    Belum ada riwayat kegiatan.
                </div>
            @else
                <ul class="space-y-3">
                    @foreach($kegiatans as $kegiatan)
                        <li class="flex items-center gap-3 rounded-xl border border-[#DAF1DE] bg-white p-3.5 shadow-sm">
                            <span class="flex h-10 w-10 items-center justify-center rounded-full bg-[#DAF1DE] text-[#235347]">
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <div>
                                <p class="font-bold text-[#051F20]">{{ $kegiatan['nama'] }}</p>
                                <p class="text-xs font-semibold text-[#55766A]">
                                    {{ $kegiatan['tanggal'] ? \Carbon\Carbon::parse($kegiatan['tanggal'])->translatedFormat('d F Y') : '-' }}
                                </p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Riwayat Pemeriksaan --}}
        <div>
            <h2 class="mb-4 text-xl font-extrabold text-[#051F20] border-b border-[#DAF1DE] pb-2">Riwayat Pemeriksaan</h2>
            @if($warga->pemeriksaans->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-8 text-center text-sm font-medium text-slate-500">
                    Belum ada riwayat pemeriksaan.
                </div>
            @else
                <div class="space-y-4">
                    @foreach($warga->pemeriksaans as $pemeriksaan)
                        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-sm">
                            <div class="mb-4 flex items-center justify-between border-b border-slate-100 pb-3">
                                <span class="font-extrabold text-[#051F20]">
                                    {{ $pemeriksaan->tanggal ? \Carbon\Carbon::parse($pemeriksaan->tanggal)->translatedFormat('d F Y') : '-' }}
                                </span>
                                @php
                                    $giziLower = strtolower($pemeriksaan->status_gizi ?? '');
                                    $giziBadge = 'bg-slate-100 text-slate-700 border-slate-200';
                                    if (preg_match('/baik|normal|ideal/i', $giziLower)) {
                                        $giziBadge = 'bg-emerald-50 text-emerald-800 border-emerald-200';
                                    } elseif (preg_match('/kurang|stunting|obesitas|sangat|risiko/i', $giziLower)) {
                                        $giziBadge = 'bg-rose-50 text-rose-800 border-rose-200';
                                    }
                                @endphp
                                <span class="inline-flex rounded-full px-2.5 py-0.5 text-xs font-bold border {{ $giziBadge }}">
                                    {{ $pemeriksaan->status_gizi ?? '-' }}
                                </span>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-y-3 text-sm sm:grid-cols-4">
                                <div>
                                    <span class="block text-xs font-semibold text-[#7FA08C]">Berat</span>
                                    <span class="font-bold text-[#051F20]">{{ $pemeriksaan->berat_badan ? $pemeriksaan->berat_badan . ' kg' : '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-[#7FA08C]">Tinggi</span>
                                    <span class="font-bold text-[#051F20]">{{ $pemeriksaan->tinggi_badan ? $pemeriksaan->tinggi_badan . ' cm' : '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-[#7FA08C]">Tekanan Darah</span>
                                    <span class="font-bold text-[#051F20]">{{ $pemeriksaan->tekanan_darah ?? '-' }}</span>
                                </div>
                                <div>
                                    <span class="block text-xs font-semibold text-[#7FA08C]">Gula Darah</span>
                                    <span class="font-bold text-[#051F20]">{{ $pemeriksaan->gula_darah ? $pemeriksaan->gula_darah . ' mg/dL' : '-' }}</span>
                                </div>
                            </div>
                            
                            @if($pemeriksaan->keluhan || $pemeriksaan->catatan)
                                <div class="mt-4 border-t border-slate-100 pt-3">
                                    @if($pemeriksaan->keluhan)
                                        <p class="text-xs font-semibold text-[#7FA08C]">Keluhan:</p>
                                        <p class="mb-2 text-sm text-[#051F20]">{{ $pemeriksaan->keluhan }}</p>
                                    @endif
                                    @if($pemeriksaan->catatan)
                                        <p class="text-xs font-semibold text-[#7FA08C]">Catatan:</p>
                                        <p class="text-sm text-[#051F20]">{{ $pemeriksaan->catatan }}</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>

</x-layouts.panel>