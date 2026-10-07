<x-layouts.panel title="Detail Kegiatan">
<div
    x-data="{ user: null }"
    x-init="getMe().then(u => user = u).catch(e => console.log('ME ERROR', e))"
>
    <div class="mx-auto max-w-3xl">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                    Detail Kegiatan
                </h1>
                <p class="mt-1 text-sm font-semibold capitalize text-[#3C5A52]">
                    {{ $kegiatan->judul }}
                </p>
            </div>

            <a href="{{ route('kegiatan.index') }}" class="btn-secondary">
                &larr; Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 flex items-center justify-between rounded-xl border border-[#8EB69B] bg-[#DAF1DE] px-4 py-3 text-sm font-semibold text-[#051F20]">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-[#163832] hover:text-[#051F20]">&times;</button>
            </div>
        @endif

        <div class="overflow-hidden rounded-2xl border border-[#DAF1DE] bg-white shadow-sm">
            @if($kegiatan->foto)
                <div class="border-b border-[#DAF1DE] bg-[#DAF1DE]/20 p-4">
                    <img
                        src="{{ asset('storage/'.$kegiatan->foto) }}"
                        alt="Foto {{ $kegiatan->judul }}"
                        class="h-64 w-full rounded-xl object-cover shadow-sm sm:h-80"
                    >
                </div>
            @endif

            <div class="grid gap-px bg-[#DAF1DE]/40 text-sm md:grid-cols-2">
                <div class="bg-white px-5 py-4 md:col-span-2">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Judul Kegiatan
                    </dt>
                    <dd class="mt-1 text-lg font-extrabold text-[#051F20] sm:text-xl">
                        {{ $kegiatan->judul }}
                    </dd>
                </div>

                <div class="bg-white px-5 py-4">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Jenis Kegiatan
                    </dt>
                    <dd class="mt-1 text-base font-bold text-[#163832]">
                        {{ ucfirst($kegiatan->jenis) }}
                    </dd>
                </div>

                <div class="bg-white px-5 py-4">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Status
                    </dt>
                    <dd class="mt-1.5">
                        @if($kegiatan->status == 'aktif')
                            <span class="badge-mint">Aktif</span>
                        @else
                            <span class="badge-gray">Nonaktif</span>
                        @endif
                    </dd>
                </div>

                <div class="bg-white px-5 py-4 md:col-span-2">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Deskripsi
                    </dt>
                    <dd class="mt-1 font-medium leading-relaxed text-[#051F20]">
                        {{ $kegiatan->deskripsi ?? 'Tidak ada deskripsi' }}
                    </dd>
                </div>

                <div class="bg-white px-5 py-4">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Target Peserta
                    </dt>
                    <dd class="mt-1 font-semibold text-[#163832]">
                        {{ $kegiatan->target_peserta ?? '-' }}
                    </dd>
                </div>

                <div class="bg-white px-5 py-4">
                    <dt class="text-xs font-bold uppercase tracking-wider text-[#7FA08C]">
                        Foto / Banner
                    </dt>
                    <dd class="mt-1 font-mono text-xs text-[#55766A]">
                        {{ $kegiatan->foto ?? 'Tidak ada foto' }}
                    </dd>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <div x-show="user?.role === 'admin'" x-cloak>
                <a href="{{ route('kegiatan.edit', $kegiatan) }}" class="btn-primary">
                    Edit Kegiatan
                </a>
            </div>
        </div>
    </div>
</div>
</x-layouts.panel>