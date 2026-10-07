<x-layouts.panel title="Kegiatan">

    <div
        x-data="{ user: null }"
        x-init="
            getMe()
                .then(u => user = u)
                .catch(e => console.log('ME ERROR', e))
        "
    >

        @php
            $btn = 'inline-flex items-center justify-center rounded-lg px-3 py-1.5 text-xs font-medium transition';
            $primary = $btn.' bg-emerald-600 text-white hover:bg-emerald-700';
            $ghost = $btn.' border border-slate-200 text-slate-600 hover:bg-slate-50';
        @endphp

        <div class="mb-6 flex items-end justify-between">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                    Kegiatan Posyandu
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola daftar kegiatan Posyandu.
                </p>
            </div>

            {{-- ADMIN ONLY --}}
            <div x-show="user?.role === 'admin'" x-cloak>
                <a href="{{ route('kegiatan.create') }}" class="{{ $primary }}">
                    + Tambah Kegiatan
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-100 p-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        {{-- Filter --}}
        <form method="GET"
              class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

            <div class="flex flex-col gap-3 md:flex-row">

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="Cari kegiatan..."
                    class="flex-1 rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                >

                <select
                    name="status"
                    class="rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                >
                    <option value="">Semua status</option>

                    @foreach($statuses as $key => $label)
                        <option
                            value="{{ $key }}"
                            {{ request('status') == $key ? 'selected' : '' }}
                        >
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button class="{{ $primary }}">
                    Filter
                </button>

            </div>
        </form>

        {{-- Table --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="overflow-x-auto">

                <table class="min-w-full text-sm">

                    <thead class="bg-slate-50 text-left text-slate-600">
                        <tr>
                            <th class="px-5 py-4 font-semibold">Judul</th>
                            <th class="px-5 py-4 font-semibold">Jenis</th>
                            <th class="px-5 py-4 font-semibold">Target Peserta</th>
                            <th class="px-5 py-4 font-semibold">Status</th>
                            <th class="px-5 py-4 text-right font-semibold">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($kegiatans as $kegiatan)

                            <tr class="hover:bg-slate-50">

                                <td class="px-5 py-4">
                                    <p class="font-semibold text-slate-900">
                                        {{ $kegiatan->judul }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $kegiatan->deskripsi ?? '-' }}
                                    </p>
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ ucfirst($kegiatan->jenis) }}
                                </td>

                                <td class="px-5 py-4 text-slate-600">
                                    {{ $kegiatan->target_peserta ?? '-' }}
                                </td>

                                <td class="px-5 py-4">

                                    @if($kegiatan->status == 'aktif')

                                        <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                                            Aktif
                                        </span>

                                    @else

                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                                            Nonaktif
                                        </span>

                                    @endif

                                </td>

                                <td class="px-5 py-4 text-right">

                                    {{-- Semua role --}}
                                    <a
                                        href="{{ route('kegiatan.show', $kegiatan) }}"
                                        class="{{ $ghost }}"
                                    >
                                        Detail
                                    </a>

                                    {{-- ADMIN ONLY --}}
                                    <div
                                        x-show="user?.role === 'admin'"
                                        x-cloak
                                        class="inline"
                                    >

                                        <a
                                            href="{{ route('kegiatan.edit', $kegiatan) }}"
                                            class="{{ $ghost }} ml-2"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('kegiatan.destroy', $kegiatan) }}"
                                            method="POST"
                                            class="inline"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                onclick="return confirm('Hapus kegiatan?')"
                                                class="ml-2 rounded-lg bg-red-50 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-100"
                                            >
                                                Hapus
                                            </button>
                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td
                                    colspan="5"
                                    class="px-5 py-10 text-center text-slate-500"
                                >
                                    Belum ada kegiatan.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="mt-6">
            {{ $kegiatans->links() }}
        </div>

    </div>

</x-layouts.panel>