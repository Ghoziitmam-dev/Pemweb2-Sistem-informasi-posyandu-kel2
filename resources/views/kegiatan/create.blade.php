<x-layouts.panel title="Tambah Kegiatan">


<div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">


    <div class="mb-6">

        <h1 class="text-2xl font-bold tracking-tight text-slate-900">
            Tambah Kegiatan
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Tambahkan informasi kegiatan Posyandu baru.
        </p>

    </div>



    <form method="POST"
          action="{{ route('kegiatan.store') }}"
          enctype="multipart/form-data">

        @csrf


        <div class="space-y-5">


            {{-- Judul --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Judul Kegiatan
                </label>


                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul') }}"
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
                    value="{{ old('jenis') }}"
                    placeholder="Contoh: Penimbangan, Imunisasi"
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
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('deskripsi') }}</textarea>

            </div>





            {{-- Target --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Target Peserta
                </label>


                <input
                    type="text"
                    name="target_peserta"
                    value="{{ old('target_peserta') }}"
                    placeholder="Contoh: Balita, Lansia, Ibu Hamil"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm focus:border-emerald-500 focus:ring-emerald-500">

            </div>





            {{-- Foto --}}
            <div>

                <label class="text-sm font-semibold text-slate-700">
                    Foto Kegiatan
                </label>


                <input
                    type="file"
                    name="foto"
                    accept="image/*"
                    onchange="cekUkuranFoto(this)"
                    class="mt-1 block w-full rounded-lg border-slate-300 text-sm">


                <p id="error-foto"
                class="mt-1 hidden text-xs text-red-600">
                    Ukuran file lebih dari 2 MB. Silakan pilih foto lain.
                </p>


                <p class="mt-1 text-xs text-slate-500">
                    Format gambar: JPG, PNG, JPEG. Maksimal 2 MB.
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
                        {{ old('status') == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>


                    <option value="nonaktif"
                        {{ old('status') == 'nonaktif' ? 'selected' : '' }}>
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

                    Simpan

                </button>

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


            </div>



        </div>


    </form>


</div>


</x-layouts.panel>