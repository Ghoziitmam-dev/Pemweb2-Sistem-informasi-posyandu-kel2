<x-layouts.panel title="Edit Kegiatan">


<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


    <div class="mb-6">

        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            Edit Kegiatan
        </h1>


        <p class="mt-1 text-sm text-slate-500">
            Perbarui informasi kegiatan Posyandu.
        </p>

    </div>




    <form method="POST"
          action="{{ route('kegiatan.update', $kegiatan) }}"
          enctype="multipart/form-data">


        @csrf
        @method('PUT')


        <div class="space-y-5">



            {{-- Judul --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Judul Kegiatan
                </label>


                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul', $kegiatan->judul) }}"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">


                @error('judul')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>





            {{-- Jenis --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Jenis Kegiatan
                </label>


                <input
                    type="text"
                    name="jenis"
                    value="{{ old('jenis', $kegiatan->jenis) }}"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">


                @error('jenis')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>





            {{-- Deskripsi --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Deskripsi
                </label>


                <textarea
                    name="deskripsi"
                    rows="4"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>


            </div>





            {{-- Target Peserta --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Target Peserta
                </label>


                <input
                    type="text"
                    name="target_peserta"
                    value="{{ old('target_peserta', $kegiatan->target_peserta) }}"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>





            {{-- Foto --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Foto Kegiatan
                </label>


                @if($kegiatan->foto)

                    <div class="mt-3 mb-3">

                        <p class="mb-2 text-xs text-slate-500">
                            Foto saat ini:
                        </p>


                        <img
                            src="{{ asset('storage/'.$kegiatan->foto) }}"
                            class="h-40 w-40 rounded-xl object-cover shadow">

                    </div>

                @else

                    <p class="mt-2 text-sm text-slate-500">
                        Belum ada foto.
                    </p>

                @endif



                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    onchange="cekUkuranFoto(this)"
                    class="mt-2 block w-full rounded-lg border-slate-300 text-sm">


                <p class="mt-1 text-xs text-slate-500">
                    Pilih foto baru jika ingin mengganti foto lama. Maksimal 2 MB.
                </p>


                <p id="error-foto"
                   class="mt-1 hidden text-xs text-red-600">
                    Ukuran file lebih dari 2 MB.
                </p>


                @error('foto')
                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>
                @enderror


            </div>





            {{-- Status --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Status
                </label>


                <select
                    name="status"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">


                    <option value="aktif"
                        {{ old('status', $kegiatan->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>


                    <option value="nonaktif"
                        {{ old('status', $kegiatan->status) == 'nonaktif' ? 'selected' : '' }}>
                        Nonaktif
                    </option>


                </select>

            </div>





            {{-- Tombol --}}
            <div class="flex justify-end gap-3">


                <a href="{{ route('kegiatan.index') }}"
                   class="rounded-lg border border-slate-200 px-4 py-2 text-sm text-slate-600 hover:bg-slate-50">

                    Batal

                </a>



                <button
                    type="submit"
                    class="rounded-lg bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700">

                    Update

                </button>


            </div>



        </div>


    </form>


</div>



<script>
function cekUkuranFoto(input) {

    const file = input.files[0];
    const error = document.getElementById('error-foto');

    if (file && file.size > 2 * 1024 * 1024) {

        error.classList.remove('hidden');
        input.value = '';

    } else {

        error.classList.add('hidden');

    }

}
</script>


</x-layouts.panel>