<x-layouts.panel title="Edit Kegiatan">
<div class="mx-auto max-w-3xl">
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#051F20]">
                    Edit Kegiatan
                </h1>
                <p class="mt-1 text-sm text-[#3C5A52]">
                    Perbarui rincian dan status kegiatan Posyandu.
                </p>
            </div>
            <a href="{{ route('kegiatan.index') }}" class="btn-secondary">
                &larr; Kembali
            </a>
        </div>

        <form method="POST"
              action="{{ route('kegiatan.update', $kegiatan) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">
                <div>
                    <label class="input-label">Judul Kegiatan</label>
                    <input
                        type="text"
                        name="judul"
                        class="input-field mt-1.5"
                        value="{{ old('judul', $kegiatan->judul) }}"
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
                            class="input-field mt-1.5"
                            value="{{ old('jenis', $kegiatan->jenis) }}"
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
                            class="input-field mt-1.5"
                            value="{{ old('target_peserta', $kegiatan->target_peserta) }}"
                        />
                        @error('target_peserta')
                            <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label class="input-label">Deskripsi</label>
                    <textarea
                        name="deskripsi"
                        rows="3"
                        class="input-field mt-1.5"
                    >{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label">Foto Kegiatan</label>

                    @if($kegiatan->foto)
                        <div class="mt-3 mb-3">
                            <p class="mb-2 text-xs text-slate-500">
                                Foto saat ini:
                            </p>
                            <img
                                src="{{ asset('storage/'.$kegiatan->foto) }}"
                                class="h-40 w-40 rounded-xl object-cover shadow"
                            >
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
                        class="input-field mt-1.5"
                    >

                    <p class="mt-1 text-xs text-slate-500">
                        Pilih foto baru jika ingin mengganti foto lama. Format JPG, PNG, JPEG. Maksimal 2 MB.
                    </p>

                    <p id="error-foto" class="mt-1 hidden text-xs font-semibold text-rose-600">
                        Ukuran file lebih dari 2 MB. Silakan pilih foto lain.
                    </p>

                    @error('foto')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="input-label">Status Kegiatan</label>
                    <select name="status" class="input-field mt-1.5">
                        <option value="aktif" @selected(old('status', $kegiatan->status) == 'aktif')>
                            Aktif
                        </option>
                        <option value="nonaktif" @selected(old('status', $kegiatan->status) == 'nonaktif')>
                            Nonaktif
                        </option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-8 flex justify-end gap-3 border-t border-[#DAF1DE] pt-5">
                    <a href="{{ route('kegiatan.show', $kegiatan) }}" class="btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        Simpan Perubahan
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