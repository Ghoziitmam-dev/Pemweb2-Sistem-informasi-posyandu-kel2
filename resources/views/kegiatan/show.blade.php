<x-layouts.panel title="Detail Kegiatan">


<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


    <div class="mb-6 flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold tracking-tight text-slate-900">
                {{ $kegiatan->judul }}
            </h1>


            <p class="mt-1 text-sm text-slate-500">
                Detail informasi kegiatan Posyandu.
            </p>

        </div>



        <a href="{{ route('kegiatan.index') }}"
           class="inline-flex items-center rounded-lg border border-slate-200 px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-50">

            Kembali

        </a>


    </div>





    <div class="space-y-5">



        {{-- Foto Kegiatan --}}
        <div>

            <p class="text-sm font-semibold text-slate-500">
                Foto Kegiatan
            </p>


            @if($kegiatan->foto)

                <img
                    src="{{ asset('storage/'.$kegiatan->foto) }}"
                    alt="Foto {{ $kegiatan->judul }}"
                    class="mt-3 h-64 w-full rounded-xl object-cover shadow-sm">

            @else

                <p class="mt-1 text-slate-500">
                    Belum ada foto kegiatan.
                </p>

            @endif


        </div>





        <div>

            <p class="text-sm font-semibold text-slate-500">
                Judul Kegiatan
            </p>

            <p class="mt-1 text-lg font-semibold text-slate-900">
                {{ $kegiatan->judul }}
            </p>

        </div>





        <div>

            <p class="text-sm font-semibold text-slate-500">
                Jenis Kegiatan
            </p>

            <p class="mt-1 text-slate-700">
                {{ ucfirst($kegiatan->jenis) }}
            </p>

        </div>





        <div>

            <p class="text-sm font-semibold text-slate-500">
                Deskripsi
            </p>

            <p class="mt-1 text-slate-700">
                {{ $kegiatan->deskripsi ?? '-' }}
            </p>

        </div>





        <div>

            <p class="text-sm font-semibold text-slate-500">
                Target Peserta
            </p>

            <p class="mt-1 text-slate-700">
                {{ $kegiatan->target_peserta ?? '-' }}
            </p>

        </div>





        <div>

            <p class="text-sm font-semibold text-slate-500">
                Status
            </p>


            @if($kegiatan->status == 'aktif')

                <span class="mt-1 inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">
                    Aktif
                </span>

            @else

                <span class="mt-1 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold text-slate-600">
                    Nonaktif
                </span>

            @endif


        </div>



    </div>


</div>


</x-layouts.panel>