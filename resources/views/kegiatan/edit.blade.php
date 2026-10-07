<x-layouts.panel title="Edit Kegiatan">

<div class="mx-auto max-w-3xl">

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

    <form method="POST" action="{{ route('kegiatan.update', $kegiatan) }}" class="rounded-2xl border border-[#DAF1DE] bg-white p-6 shadow-sm">
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
                @error('judul') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
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
                    @error('jenis') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="input-label">Target Peserta</label>
                    <input
                        type="text"
                        name="target_peserta"
                        class="input-field mt-1.5"
                        value="{{ old('target_peserta', $kegiatan->target_peserta) }}"
                    />
                    @error('target_peserta') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="input-label">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="3"
                    class="input-field mt-1.5"
                >{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="input-label">Status Kegiatan</label>
                    <select name="status" class="input-field mt-1.5">
                        <option value="aktif" @selected(old('status', $kegiatan->status) == 'aktif')>Aktif</option>
                        <option value="nonaktif" @selected(old('status', $kegiatan->status) == 'nonaktif')>Nonaktif</option>
                    </select>
                    @error('status') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="input-label">Foto / Banner (opsional)</label>
                    <input
                        type="text"
                        name="foto"
                        class="input-field mt-1.5"
                        value="{{ old('foto', $kegiatan->foto) }}"
                    />
                </div>
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

</x-layouts.panel>