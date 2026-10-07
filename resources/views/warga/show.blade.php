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

</div>

</x-layouts.panel>