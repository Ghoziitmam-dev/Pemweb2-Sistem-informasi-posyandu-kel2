<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Jadwal Kegiatan</h2>
            @if (auth()->user()->hasRole('admin', 'kader'))
                <a href="{{ route('jadwal.create') }}"
                   class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    + Tambah Jadwal
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">{{ session('error') }}</div>
            @endif

            <form method="GET" class="mb-4 flex flex-col sm:flex-row gap-2">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama kegiatan..."
                       class="border-gray-300 rounded-md shadow-sm w-full sm:w-64">
                <select name="status" class="border-gray-300 rounded-md shadow-sm">
                    <option value="">Semua status</option>
                    @foreach ($statuses as $key => $label)
                        <option value="{{ $key }}" @selected(request('status') === $key)>{{ $label }}</option>
                    @endforeach
                </select>
                <button class="px-4 py-2 bg-gray-800 text-white rounded-md">Filter</button>
            </form>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Kegiatan</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Waktu</th>
                            <th class="px-4 py-3">Lokasi</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($jadwals as $jadwal)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $jadwal->kegiatan->judul }}</td>
                                <td class="px-4 py-3">{{ $jadwal->tanggal->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-3">{{ substr($jadwal->jam_mulai, 0, 5) }} - {{ substr($jadwal->jam_selesai, 0, 5) }}</td>
                                <td class="px-4 py-3">{{ $jadwal->lokasi }}</td>
                                <td class="px-4 py-3">
                                    @include('jadwal._badge', ['status' => $jadwal->status, 'label' => $statuses[$jadwal->status]])
                                </td>
                                <td class="px-4 py-3 text-right whitespace-nowrap">
                                    <a href="{{ route('jadwal.show', $jadwal) }}" class="text-indigo-600 hover:underline">Detail</a>
                                    @if (auth()->user()->hasRole('admin', 'kader'))
                                        <a href="{{ route('jadwal.edit', $jadwal) }}" class="ml-3 text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Hapus jadwal ini?')">
                                            @csrf @method('DELETE')
                                            <button class="ml-3 text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-8 text-center text-gray-500">Belum ada jadwal.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $jadwals->links() }}</div>
        </div>
    </div>
</x-app-layout>