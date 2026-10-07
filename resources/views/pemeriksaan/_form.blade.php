<div class="form-section">
    <div class="form-section-title">
        <span>Informasi Pemeriksaan</span>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="warga_id" class="form-label">Warga</label>
            <select name="warga_id" id="warga_id" class="@error('warga_id') is-invalid @enderror" required>
                @foreach ($wargas as $warga)
                    <option value="{{ $warga->id }}" {{ old('warga_id', $pemeriksaan->warga_id ?? '') == $warga->id ? 'selected' : '' }}>
                        {{ $warga->nama }} - {{ $warga->nik }}
                    </option>
                @endforeach
            </select>

            @error('warga_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="jadwal_id" class="form-label">Jadwal</label>
            <select name="jadwal_id" id="jadwal_id" required>
                <option value=""></option>

                @foreach ($jadwals as $jadwal)
                    <option value="{{ $jadwal->id }}" {{ old('jadwal_id', $pemeriksaan->jadwal_id ?? '') == $jadwal->id ? 'selected' : '' }}>
                        {{ $jadwal->tanggal?->format('d/m/Y') }} · {{ $jadwal->lokasi ?? 'Lokasi tidak tersedia' }}
                    </option>
                @endforeach
            </select>

            @error('jadwal_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="pemeriksa_id" class="form-label">Pemeriksa</label>
            <select name="pemeriksa_id" id="pemeriksa_id" required>
                <option value=""></option>

                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ old('pemeriksa_id', $pemeriksaan->pemeriksa_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>

            @error('pemeriksa_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="col-md-6">
            <label for="tanggal" class="form-label">Tanggal Pemeriksaan</label>
            <input
                type="date"
                name="tanggal"
                id="tanggal"
                class="form-control @error('tanggal') is-invalid @enderror"
                value="{{ old('tanggal', isset($pemeriksaan->tanggal) ? $pemeriksaan->tanggal->format('Y-m-d') : '') }}"
                required
            >

            @error('tanggal')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-section">
    <div class="form-section-title">
        <span>Hasil Pengukuran</span>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="berat_badan" class="form-label">
                Berat Badan <small>(kg)</small>
            </label>

            <div class="input-unit">
                <input
                    type="number"
                    step="0.01"
                    name="berat_badan"
                    id="berat_badan"
                    class="form-control"
                    placeholder="Contoh: 55"
                    value="{{ old('berat_badan', $pemeriksaan->berat_badan ?? '') }}"
                >
                <span>kg</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="tinggi_badan" class="form-label">
                Tinggi Badan <small>(cm)</small>
            </label>

            <div class="input-unit">
                <input
                    type="number"
                    step="0.01"
                    name="tinggi_badan"
                    id="tinggi_badan"
                    class="form-control"
                    placeholder="Contoh: 165"
                    value="{{ old('tinggi_badan', $pemeriksaan->tinggi_badan ?? '') }}"
                >
                <span>cm</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="lingkar_kepala" class="form-label">
                Lingkar Kepala <small>(cm)</small>
            </label>

            <div class="input-unit">
                <input
                    type="number"
                    step="0.01"
                    name="lingkar_kepala"
                    id="lingkar_kepala"
                    class="form-control"
                    placeholder="Contoh: 54"
                    value="{{ old('lingkar_kepala', $pemeriksaan->lingkar_kepala ?? '') }}"
                >
                <span>cm</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="lingkar_lengan" class="form-label">
                Lingkar Lengan <small>(cm)</small>
            </label>

            <div class="input-unit">
                <input
                    type="number"
                    step="0.01"
                    name="lingkar_lengan"
                    id="lingkar_lengan"
                    class="form-control"
                    placeholder="Contoh: 25"
                    value="{{ old('lingkar_lengan', $pemeriksaan->lingkar_lengan ?? '') }}"
                >
                <span>cm</span>
            </div>
        </div>
    </div>
</div>

<div class="form-section">
    <div class="form-section-title">
        <span>Kondisi Kesehatan</span>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="tekanan_darah" class="form-label">
                Tekanan Darah <small>(mmHg)</small>
            </label>

            <div class="input-unit">
                <input
                    type="text"
                    name="tekanan_darah"
                    id="tekanan_darah"
                    class="form-control"
                    placeholder="Contoh: 120/80"
                    value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah ?? '') }}"
                >
                <span>mmHg</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="gula_darah" class="form-label">
                Gula Darah <small>(mg/dL)</small>
            </label>

            <div class="input-unit">
                <input
                    type="number"
                    step="0.01"
                    name="gula_darah"
                    id="gula_darah"
                    class="form-control"
                    placeholder="Contoh: 100"
                    value="{{ old('gula_darah', $pemeriksaan->gula_darah ?? '') }}"
                >
                <span>mg/dL</span>
            </div>
        </div>

        <div class="col-md-6">
            <label for="status_gizi" class="form-label">
                Status Gizi
            </label>

            <select name="status_gizi" id="status_gizi">
                <option value=""></option>

                @foreach (['Sangat Kurus', 'Kurus', 'Normal', 'Gemuk', 'Obesitas'] as $status)
                    <option value="{{ $status }}" {{ old('status_gizi', $pemeriksaan->status_gizi ?? '') == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
</div>

<div class="form-section">
    <div class="form-section-title">
        <span>Keluhan & Catatan</span>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <label for="keluhan" class="form-label">
                Keluhan
            </label>

            <textarea
                name="keluhan"
                id="keluhan"
                rows="4"
                class="form-control"
                placeholder="Tuliskan keluhan warga jika ada..."
            >{{ old('keluhan', $pemeriksaan->keluhan ?? '') }}</textarea>
        </div>

        <div class="col-md-6">
            <label for="catatan" class="form-label">
                Catatan
            </label>

            <textarea
                name="catatan"
                id="catatan"
                rows="4"
                class="form-control"
                placeholder="Tambahkan catatan pemeriksaan..."
            >{{ old('catatan', $pemeriksaan->catatan ?? '') }}</textarea>
        </div>
    </div>
</div>