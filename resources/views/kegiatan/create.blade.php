<x-layouts.panel title="Tambah Kegiatan">
<div class="mx-auto max-w-3xl">
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                    Tambah Kegiatan
                </h1>
                <p class="mt-1 text-sm text-[#3C5A52]">
                    Daftarkan kegiatan baru ke dalam sistem Posyandu.
                </p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="btn-secondary">
                &larr; Kembali
            </a>
        </div>

        <form method="POST"
              action="{{ route('kegiatan.store') }}"
              enctype="multipart/form-data">
            @csrf

            <div class="space-y-5">
                <div>
                    <label class="input-label">Judul Kegiatan</label>
                    <input
                        type="text"
                        name="judul"
                        placeholder="Contoh: Penimbangan Balita & Posyandu Lansia"
                        class="input-field mt-1.5"
                        value="{{ old('judul') }}"
                        required
                    />
                    @error('judul')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <div>
                        <label class="input-label">Jenis Kegiatan</label>
                        <input
                            type="text"
                            name="jenis"
                            placeholder="Contoh: Penimbangan / Imunisasi"
                            class="input-field mt-1.5"
                            value="{{ old('jenis') }}"
                            required
                        />
                        @error('jenis')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="input-label">Target Peserta</label>
                        <input
                            type="text"
                            name="target_peserta"
                            placeholder="Contoh: Balita usia 0-5 tahun"
                            class="input-field mt-1.5"
                            value="{{ old('target_peserta') }}"
                        />
                        @error('target_peserta')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="input-label">Deskripsi Kegiatan</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        placeholder="Penjelasan detail tentang agenda kegiatan..."
                        class="input-field mt-1.5"
                    >{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label">Foto Kegiatan</label>
                    <input
                        type="file"
                        name="foto"
                        accept="image/*"
                        onchange="cekUkuranFoto(this)"
                        class="input-field mt-1.5"
                    >

                    <p id="error-foto" class="mt-1 hidden text-xs font-semibold text-rose-600">
                        Ukuran file lebih dari 2 MB. Silakan pilih foto lain.
                    </p>

                    <p class="mt-1 text-xs text-slate-500">
                        Format gambar: JPG, PNG, JPEG. Maksimal 2 MB.
                    </p>

                    @error('foto')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label">Status Kegiatan</label>
                    <select name="status" class="input-field mt-1.5">
                        <option value="aktif" @selected(old('status') === 'aktif')>
                            Aktif
                        </option>
                        <option value="nonaktif" @selected(old('status') === 'nonaktif')>
                            Nonaktif
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-[#DAF1DE] pt-5">
                    <a href="{{ route('kegiatan.index') }}" class="btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        Simpan Kegiatan
                    </button>
                </div>
            </div>
        </form>
    </div>
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