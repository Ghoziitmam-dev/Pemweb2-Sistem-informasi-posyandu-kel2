<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Data Kegiatan
            </h2>

            <a href="{{ route('kegiatan.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                + Tambah Kegiatan
            </a>
        </div>
    </x-slot>


    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif


            <form method="GET" class="mb-4 flex gap-2">

                <input type="text"
                       name="q"
                       value="{{ request('q') }}"
                       placeholder="Cari kegiatan..."
                       class="border-gray-300 rounded-md shadow-sm">

                <select name="status"
                        class="border-gray-300 rounded-md shadow-sm">

                    <option value="">Semua status</option>

                    @foreach($statuses as $key => $label)
                        <option value="{{ $key }}">
                            {{ $label }}
                        </option>
                    @endforeach

                </select>


                <button class="px-4 py-2 bg-gray-800 text-white rounded-md">
                    Filter
                </button>

            </form>


            <div class="bg-white shadow-sm sm:rounded-lg overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200 text-sm">

                    <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="px-4 py-3">Judul</th>
                            <th class="px-4 py-3">Jenis</th>
                            <th class="px-4 py-3">Target Peserta</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-right">Aksi</th>
                        </tr>
                    </thead>


                    <tbody class="divide-y divide-gray-100">

                    @forelse($kegiatans as $kegiatan)

                        <tr>

                            <td class="px-4 py-3 font-medium">
                                {{ $kegiatan->judul }}
                            </td>


                            <td class="px-4 py-3">
                                {{ $kegiatan->jenis }}
                            </td>


                            <td class="px-4 py-3">
                                {{ $kegiatan->target_peserta ?? '-' }}
                            </td>


                            <td class="px-4 py-3">

                                @if($kegiatan->status == 'aktif')
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-700">
                                        Nonaktif
                                    </span>
                                @endif

                            </td>


                            <td class="px-4 py-3 text-right">

                                <a href="{{ route('kegiatan.show',$kegiatan) }}"
                                   class="text-indigo-600 hover:underline">
                                    Detail
                                </a>


                                <a href="{{ route('kegiatan.edit',$kegiatan) }}"
                                   class="ml-3 text-yellow-600 hover:underline">
                                    Edit
                                </a>


                                <form action="{{ route('kegiatan.destroy',$kegiatan) }}"
                                      method="POST"
                                      class="inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="ml-3 text-red-600 hover:underline"
                                            onclick="return confirm('Hapus kegiatan?')">
                                        Hapus
                                    </button>

                                </form>


                            </td>

                        </tr>


                    @empty

                        <tr>
                            <td colspan="5"
                                class="px-4 py-8 text-center text-gray-500">
                                Belum ada kegiatan.
                            </td>
                        </tr>

                    @endforelse


                    </tbody>

                </table>

            </div>


            <div class="mt-4">
                {{ $kegiatans->links() }}
            </div>


        </div>
    </div>

</x-app-layout>