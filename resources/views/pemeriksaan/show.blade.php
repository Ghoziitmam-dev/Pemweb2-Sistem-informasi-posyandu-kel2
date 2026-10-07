<x-layouts.panel title="Detail Pemeriksaan">

<div class="mx-auto max-w-4xl">

    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                Detail Pemeriksaan
            </h1>
            <p class="mt-1 text-sm font-semibold text-[#3C5A52]">
                Rekam medis & hasil pengukuran Posyandu
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a href="{{ route('pemeriksaan.edit', $pemeriksaan) }}" class="btn-primary">
                Edit Data
            </a>
            <a href="{{ route('pemeriksaan.index') }}" class="btn-secondary">
                &larr; Kembali
            </a>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">

        {{-- Data Warga Card --}}
        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
            <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
                <svg class="h-5 w-5 text-[#235347]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Informasi Warga
            </h3>

            <dl class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Nama Lengkap</dt>
                    <dd class="font-extrabold text-[#051F20]">{{ $pemeriksaan->warga?->nama ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">NIK</dt>
                    <dd class="font-mono font-bold text-[#163832]">{{ $pemeriksaan->warga?->nik ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Jenis Kelamin</dt>
                    <dd class="font-semibold text-[#163832]">{{ $pemeriksaan->warga?->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Kategori</dt>
                    <dd><span class="badge-mint">{{ ucfirst($pemeriksaan->warga?->kategori ?? '-') }}</span></dd>
                </div>
                <div class="flex justify-between">
                    <dt class="font-bold text-[#7FA08C]">Alamat</dt>
                    <dd class="font-medium text-[#051F20] text-right max-w-xs">{{ $pemeriksaan->warga?->alamat ?? '-' }}</dd>
                </div>
            </dl>
        </div>

        {{-- Informas Periksa Card --}}
        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
            <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
                <svg class="h-5 w-5 text-[#235347]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                Jadwal & Petugas
            </h3>

            <dl class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Tanggal Periksa</dt>
                    <dd class="font-bold text-[#051F20]">{{ $pemeriksaan->tanggal?->format('d F Y') ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Lokasi Posyandu</dt>
                    <dd class="font-semibold text-[#163832]">{{ $pemeriksaan->jadwal?->lokasi ?? '-' }}</dd>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <dt class="font-bold text-[#7FA08C]">Pemeriksa / Kader</dt>
                    <dd class="font-bold text-[#051F20]">{{ $pemeriksaan->pemeriksa?->name ?? '-' }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="font-bold text-[#7FA08C]">Status Gizi</dt>
                    <dd>
                        @if($pemeriksaan->status_gizi)
                            <span class="badge-mint">{{ $pemeriksaan->status_gizi }}</span>
                        @else
                            -
                        @endif
                    </dd>
                </div>
            </dl>
        </div>

        {{-- Hasil Pengukuran Card --}}
        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs md:col-span-2">
            <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
                <svg class="h-5 w-5 text-[#235347]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Hasil Pengukuran Fisik & Kesehatan
            </h3>

            <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-6 text-center">
                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Berat Badan</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->berat_badan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">kg</small></span>
                </div>

                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Tinggi Badan</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->tinggi_badan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                </div>

                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Lingkar Kepala</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->lingkar_kepala ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                </div>

                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Lingkar Lengan</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->lingkar_lengan ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">cm</small></span>
                </div>

                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Tekanan Darah</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->tekanan_darah ?? '-' }}</span>
                </div>

                <div class="rounded-xl bg-[#DAF1DE]/40 p-3 border border-[#DAF1DE]">
                    <span class="text-xs font-semibold text-[#55766A] block">Gula Darah</span>
                    <span class="text-lg font-extrabold text-[#051F20] tabular-nums mt-1 block">{{ $pemeriksaan->gula_darah ?? '-' }} <small class="text-xs font-bold text-[#7FA08C]">mg/dL</small></span>
                </div>
            </div>
        </div>

        {{-- Keluhan Card --}}
        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
            <h4 class="font-bold text-[#051F20] text-sm mb-2">Keluhan Warga</h4>
            <p class="text-sm text-[#163832] leading-relaxed bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                {{ $pemeriksaan->keluhan ?: 'Tidak ada keluhan yang dilaporkan.' }}
            </p>
        </div>

        {{-- Catatan Card --}}
        <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
            <h4 class="font-bold text-[#051F20] text-sm mb-2">Catatan / Tindakan Kader</h4>
            <p class="text-sm text-[#163832] leading-relaxed bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                {{ $pemeriksaan->catatan ?: 'Tidak ada catatan khusus.' }}
            </p>
        </div>

    </div>

</div>

</x-layouts.panel>