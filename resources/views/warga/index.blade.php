<x-layouts.panel title="Warga">

@php
    $btn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-medium transition';
    $primary = $btn.' bg-emerald-600 text-white hover:bg-emerald-700';
    $ghost = $btn.' border border-slate-200 text-slate-600 hover:bg-slate-50';
    $danger = $btn.' text-red-600 hover:bg-red-50';
    $input = 'rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500';
@endphp

<div>

    {{-- Alert sukses --}}
    @if (session('success'))
        <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-6 flex items-end justify-between">

        <div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                Data Warga
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola data warga Posyandu.
            </p>
        </div>

        <a href="{{ route('warga.create') }}" class="{{ $primary }}">
            + Tambah Warga
        </a>

    </div>


    {{-- Filter --}}
    <form method="GET" class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

        <div class="grid gap-3 md:grid-cols-12">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama atau NIK..."
                class="{{ $input }} md:col-span-8">

            <select name="kategori" class="{{ $input }} md:col-span-4">

                <option value="">Semua kategori</option>

                @foreach ($kategoris as $key => $label)
                    <option value="{{ $key }}" {{ request('kategori') == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach

            </select>

        </div>

        <button class="{{ $primary }} mt-4">
            Filter
        </button>

    </form>


    {{-- Table --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full text-sm">

                <thead class="bg-slate-50 text-left text-slate-600">

                    <tr>

                        <th class="px-5 py-4 font-semibold">NIK</th>
                        <th class="px-5 py-4 font-semibold">Nama</th>
                        <th class="px-5 py-4 font-semibold">Usia / JK</th>
                        <th class="px-5 py-4 font-semibold">Kategori</th>
                        <th class="px-5 py-4 font-semibold">RT/RW</th>
                        <th class="px-5 py-4 text-right font-semibold">Aksi</th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-slate-100">

                @forelse ($wargas as $warga)

                    <tr class="hover:bg-slate-50">

                        <td class="px-5 py-4 font-mono text-xs text-slate-600">
                            {{ $warga->nik }}
                        </td>

                        <td class="px-5 py-4">
                            <p class="font-semibold text-slate-900">{{ $warga->nama }}</p>
                            <p class="mt-0.5 text-xs text-slate-500">{{ $warga->nama_wali ? 'Wali: '.$warga->nama_wali : '-' }}</p>
                        </td>

                        <td class="px-5 py-4 text-slate-600">
                            {{ $warga->umur }} th
                            <span class="text-xs text-slate-400">/ {{ $warga->jenis_kelamin == 'L' ? 'L' : 'P' }}</span>
                        </td>

                        <td class="px-5 py-4">
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                {{ $warga->kategori == 'ibu_hamil' ? 'Ibu Hamil' : ucfirst($warga->kategori) }}
                            </span>
                        </td>

                        <td class="px-5 py-4 text-slate-600">
                            {{ $warga->rt_rw }}
                        </td>

                        <td class="px-5 py-4 text-right whitespace-nowrap">

                            <a href="{{ route('warga.show', $warga) }}" class="{{ $ghost }}">
                                Detail
                            </a>

                            <a href="{{ route('warga.edit', $warga) }}" class="{{ $ghost }} ml-2">
                                Edit
                            </a>

                            <form action="{{ route('warga.destroy', $warga) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Hapus data warga ini?')"
                                    class="{{ $danger }} ml-2">
                                    Hapus
                                </button>
                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                            Belum ada data warga.
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <div class="mt-6">
        {{ $wargas->links() }}
    </div>

</div>

</x-layouts.panel>