<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Jadwal</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg space-y-3">
                <div class="flex items-start justify-between">
                    <h3 class="text-lg font-semibold">{{ $jadwal->kegiatan->judul }}</h3>
                    @include('jadwal._badge', ['status' => $jadwal->status, 'label' => $statuses[$jadwal->status]])
                </div>
                <p class="text-gray-600">{{ $jadwal->kegiatan->deskripsi }}</p>

                <dl class="grid grid-cols-3 gap-y-2 text-sm">
                    <dt class="text-gray-500">Tanggal</dt>
                    <dd class="col-span-2">{{ $jadwal->tanggal->translatedFormat('l, d F Y') }}</dd>
                    <dt class="text-gray-500">Waktu</dt>
                    <dd class="col-span-2">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }} WIB</dd>
                    <dt class="text-gray-500">Lokasi</dt>
                    <dd class="col-span-2">{{ $jadwal->lokasi }}</dd>
                    <dt class="text-gray-500">Petugas</dt>
                    <dd class="col-span-2">{{ $jadwal->petugas ?? '-' }}</dd>
                    <dt class="text-gray-500">Pemeriksaan</dt>
                    <dd class="col-span-2">{{ $jadwal->pemeriksaans_count }} warga sudah diperiksa</dd>
                </dl>

                <div class="pt-4 flex flex-wrap gap-2">
                    <a href="{{ route('jadwal.index') }}" class="px-4 py-2 border rounded-md text-gray-700">Kembali</a>

                    @if (auth()->user()->hasRole('admin', 'kader'))
                        <a href="{{ route('jadwal.edit', $jadwal) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-md">Edit</a>

                        {{-- Tombol aktif setelah Diva membuat route pemeriksaan --}}
                        @if (Route::has('pemeriksaan.create'))
                            <a href="{{ route('pemeriksaan.create', ['jadwal_id' => $jadwal->id]) }}"
                               class="px-4 py-2 bg-green-600 text-white rounded-md">Mulai Pemeriksaan</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>