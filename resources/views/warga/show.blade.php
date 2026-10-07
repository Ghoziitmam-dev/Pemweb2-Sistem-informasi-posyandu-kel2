<x-layouts.panel title="Detail Warga">

@php
    $btn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-medium transition';
    $primary = $btn.' bg-emerald-600 text-white hover:bg-emerald-700';
    $ghost = $btn.' border border-slate-200 text-slate-600 hover:bg-slate-50';
    $labels = [
        'balita' => 'Balita',
        'ibu_hamil' => 'Ibu Hamil',
        'remaja' => 'Remaja',
        'dewasa' => 'Dewasa',
        'lansia' => 'Lansia',
    ];
@endphp

<div class="mx-auto max-w-3xl">

    <div class="mb-6 flex items-end justify-between">

        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Detail Warga
            </h1>

            <p class="mt-1 text-sm capitalize text-slate-500">
                {{ $warga->nama }}
            </p>
        </div>

        <a href="{{ route('warga.index') }}" class="{{ $ghost }}">
            &larr; Kembali
        </a>

    </div>

    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="grid gap-px bg-slate-100 text-sm md:grid-cols-2">

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">NIK</dt>
                <dd class="mt-1 font-mono text-slate-900">{{ $warga->nik }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Nama</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->nama }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Tanggal Lahir</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->tanggal_lahir->format('d/m/Y') }} ({{ $warga->umur }} th)</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Jenis Kelamin</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</dd>
            </div>

            <div class="bg-white px-5 py-4 md:col-span-2">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Alamat</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->alamat }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">RT/RW</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->rt_rw }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Kategori</dt>
                <dd class="mt-1">
                    <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                        {{ $labels[$warga->kategori] ?? $warga->kategori }}
                    </span>
                </dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">Nama Wali</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->nama_wali ?? '-' }}</dd>
            </div>

            <div class="bg-white px-5 py-4">
                <dt class="text-xs font-medium uppercase tracking-wide text-slate-400">No. HP</dt>
                <dd class="mt-1 text-slate-900">{{ $warga->no_hp ?? '-' }}</dd>
            </div>

        </div>

    </div>

    <div class="mt-6 flex justify-end gap-2">

        <a href="{{ route('warga.edit', $warga) }}" class="{{ $primary }}">
            Edit Data
        </a>

    </div>

</div>

</x-layouts.panel>