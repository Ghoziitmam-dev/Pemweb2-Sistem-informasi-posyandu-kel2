<div class="space-y-6">

    {{-- Informasi Pemeriksaan --}}
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
        <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#DAF1DE] text-xs font-bold text-[#0B2B26]">1</span>
            Informasi Pemeriksaan
        </h3>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="warga_id" class="input-label">Warga</label>
                <select name="warga_id" id="warga_id" class="input-field mt-1.5" required>
                    <option value="">-- Pilih Warga --</option>
                    @foreach ($wargas as $warga)
                        <option value="{{ $warga->id }}" {{ old('warga_id', $pemeriksaan->warga_id ?? '') == $warga->id ? 'selected' : '' }}>
                            {{ $warga->nama }} - NIK: {{ $warga->nik }}
                        </option>
                    @endforeach
                </select>
                @error('warga_id') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="jadwal_id" class="input-label">Jadwal Posyandu</label>
                <select name="jadwal_id" id="jadwal_id" class="input-field mt-1.5" required>
                    <option value="">-- Pilih Jadwal --</option>
                    @foreach ($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}" {{ old('jadwal_id', $pemeriksaan->jadwal_id ?? '') == $jadwal->id ? 'selected' : '' }}>
                            {{ $jadwal->tanggal?->format('d/m/Y') }} · {{ $jadwal->lokasi ?? 'Balai Desa' }}
                        </option>
                    @endforeach
                </select>
                @error('jadwal_id') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="pemeriksa_id" class="input-label">Pemeriksa / Kader</label>
                <select name="pemeriksa_id" id="pemeriksa_id" class="input-field mt-1.5" required>
                    <option value="">-- Pilih Pemeriksa --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('pemeriksa_id', $pemeriksaan->pemeriksa_id ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
                @error('pemeriksa_id') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="tanggal" class="input-label">Tanggal Pemeriksaan</label>
                <input
                    type="date"
                    name="tanggal"
                    id="tanggal"
                    class="input-field mt-1.5"
                    value="{{ old('tanggal', isset($pemeriksaan->tanggal) ? $pemeriksaan->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
                    required
                >
                @error('tanggal') <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    {{-- Hasil Pengukuran --}}
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
        <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#DAF1DE] text-xs font-bold text-[#0B2B26]">2</span>
            Hasil Pengukuran Fisik
        </h3>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="berat_badan" class="input-label">Berat Badan (kg)</label>
                <div class="relative mt-1.5">
                    <input
                        type="number"
                        step="0.01"
                        name="berat_badan"
                        id="berat_badan"
                        class="input-field pr-12"
                        placeholder="Contoh: 15.5"
                        value="{{ old('berat_badan', $pemeriksaan->berat_badan ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3.5 top-2.5 text-xs font-bold text-[#7FA08C]">kg</span>
                </div>
            </div>

            <div>
                <label for="tinggi_badan" class="input-label">Tinggi / Panjang Badan (cm)</label>
                <div class="relative mt-1.5">
                    <input
                        type="number"
                        step="0.01"
                        name="tinggi_badan"
                        id="tinggi_badan"
                        class="input-field pr-12"
                        placeholder="Contoh: 95.0"
                        value="{{ old('tinggi_badan', $pemeriksaan->tinggi_badan ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3.5 top-2.5 text-xs font-bold text-[#7FA08C]">cm</span>
                </div>
            </div>

            <div>
                <label for="lingkar_kepala" class="input-label">Lingkar Kepala (cm)</label>
                <div class="relative mt-1.5">
                    <input
                        type="number"
                        step="0.01"
                        name="lingkar_kepala"
                        id="lingkar_kepala"
                        class="input-field pr-12"
                        placeholder="Contoh: 48.0"
                        value="{{ old('lingkar_kepala', $pemeriksaan->lingkar_kepala ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3.5 top-2.5 text-xs font-bold text-[#7FA08C]">cm</span>
                </div>
            </div>

            <div>
                <label for="lingkar_lengan" class="input-label">Lingkar Lengan Atas / LiLA (cm)</label>
                <div class="relative mt-1.5">
                    <input
                        type="number"
                        step="0.01"
                        name="lingkar_lengan"
                        id="lingkar_lengan"
                        class="input-field pr-12"
                        placeholder="Contoh: 14.5"
                        value="{{ old('lingkar_lengan', $pemeriksaan->lingkar_lengan ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3.5 top-2.5 text-xs font-bold text-[#7FA08C]">cm</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Kondisi Kesehatan & Status --}}
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
        <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#DAF1DE] text-xs font-bold text-[#0B2B26]">3</span>
            Kondisi Kesehatan & Status Gizi
        </h3>

        <div class="grid gap-5 md:grid-cols-3">
            <div>
                <label for="tekanan_darah" class="input-label">Tekanan Darah (mmHg)</label>
                <div class="relative mt-1.5">
                    <input
                        type="text"
                        name="tekanan_darah"
                        id="tekanan_darah"
                        class="input-field pr-16"
                        placeholder="Contoh: 120/80"
                        value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3 top-2.5 text-xs font-bold text-[#7FA08C]">mmHg</span>
                </div>
            </div>

            <div>
                <label for="gula_darah" class="input-label">Gula Darah (mg/dL)</label>
                <div class="relative mt-1.5">
                    <input
                        type="number"
                        step="0.01"
                        name="gula_darah"
                        id="gula_darah"
                        class="input-field pr-16"
                        placeholder="Contoh: 100"
                        value="{{ old('gula_darah', $pemeriksaan->gula_darah ?? '') }}"
                    >
                    <span class="pointer-events-none absolute right-3 top-2.5 text-xs font-bold text-[#7FA08C]">mg/dL</span>
                </div>
            </div>

            <div>
                <label for="status_gizi" class="input-label">Status Gizi</label>
                <select name="status_gizi" id="status_gizi" class="input-field mt-1.5">
                    <option value="">-- Pilih Status Gizi --</option>
                    @foreach (['Sangat Kurus', 'Kurus', 'Normal', 'Gemuk', 'Obesitas', 'Gizi Baik', 'Gizi Kurang', 'Risiko Stunting'] as $status)
                        <option value="{{ $status }}" {{ old('status_gizi', $pemeriksaan->status_gizi ?? '') == $status ? 'selected' : '' }}>
                            {{ $status }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Keluhan & Catatan --}}
    <div class="rounded-2xl border border-[#DAF1DE] bg-white p-5 shadow-2xs">
        <h3 class="mb-4 text-base font-extrabold text-[#051F20] flex items-center gap-2 border-b border-[#DAF1DE] pb-2.5">
            <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-[#DAF1DE] text-xs font-bold text-[#0B2B26]">4</span>
            Keluhan & Catatan Tambahan
        </h3>

        <div class="grid gap-5 md:grid-cols-2">
            <div>
                <label for="keluhan" class="input-label">Keluhan Warga</label>
                <textarea
                    name="keluhan"
                    id="keluhan"
                    rows="3"
                    class="input-field mt-1.5"
                    placeholder="Tuliskan keluhan yang disampaikan..."
                >{{ old('keluhan', $pemeriksaan->keluhan ?? '') }}</textarea>
            </div>

            <div>
                <label for="catatan" class="input-label">Catatan & Tindakan Kader</label>
                <textarea
                    name="catatan"
                    id="catatan"
                    rows="3"
                    class="input-field mt-1.5"
                    placeholder="Tuliskan saran atau rujukan..."
                >{{ old('catatan', $pemeriksaan->catatan ?? '') }}</textarea>
            </div>
        </div>
    </div>

</div>