<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.4.3/dist/js/tom-select.complete.min.js"></script>

    <style>
        :root {
            --bg: #f1f9f4;
            --white: #ffffff;
            --green-dark: #205c4f;
            --green: #2f6b5d;
            --green-soft: #e8f4ec;
            --green-border: #d4e7da;
            --text: #163b33;
            --muted: #6c857d;
            --input-border: #cbded2;
        }

        * {
            box-sizing: border-box;
        }

        .pemeriksaan-create-page {
            min-height: calc(100vh - 54px);
            background: var(--bg);
            padding: 32px 20px 45px;
        }

        .pemeriksaan-create-container {
            width: 100%;
            max-width: 1176px;
            margin: 0 auto;
        }

        .create-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .create-header-left h1 {
            margin: 0;
            color: #0d3931;
            font-size: 26px;
            line-height: 1.2;
            font-weight: 700;
        }

        .create-header-left p {
            margin: 6px 0 0;
            color: #648078;
            font-size: 13px;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            height: 42px;
            padding: 0 18px;
            color: #174d42;
            background: #ffffff;
            border: 1px solid var(--green-border);
            border-radius: 10px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: .2s ease;
        }

        .btn-back:hover {
            background: var(--green-soft);
            border-color: #bfd9c8;
            color: #174d42;
        }

        /* ================= CARD ================= */

        .create-card {
            background: var(--white);
            border: 1px solid var(--green-border);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(31, 91, 77, .035);
        }

        .create-card-header {
            padding: 22px 26px;
            border-bottom: 1px solid #e1eee5;
            background: #fbfdfc;
        }

        .create-card-header h2 {
            margin: 0;
            color: #153e35;
            font-size: 18px;
            font-weight: 700;
        }

        .create-card-header p {
            margin: 5px 0 0;
            color: #718981;
            font-size: 12px;
        }

        .create-card-body {
            padding: 25px 26px 22px;
        }

        .form-error {
            margin-bottom: 20px;
            padding: 13px 16px;
            color: #8a3939;
            background: #fff5f5;
            border: 1px solid #eccccc;
            border-radius: 10px;
            font-size: 12px;
        }

        .form-error strong {
            display: block;
            margin-bottom: 5px;
        }

        .form-error ul {
            margin: 0;
            padding-left: 18px;
        }

        .form-section {
            margin-bottom: 25px;
        }

        .form-section:last-of-type {
            margin-bottom: 0;
        }

        .form-section-title {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
            color: #205c4f;
            font-size: 14px;
            font-weight: 700;
        }

        .form-section-title::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #dbeae0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px 18px;
        }

        .form-group {
            min-width: 0;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            color: #244e44;
            font-size: 12px;
            font-weight: 600;
        }

        .form-label .required {
            color: #c45b5b;
        }

        .unit {
            color: #7b928a;
            font-size: 11px;
            font-weight: 400;
        }

        .form-control {
            display: block;
            width: 100%;
            height: 42px;
            padding: 0 12px;
            color: #1d443b;
            background: #ffffff;
            border: 1px solid var(--input-border);
            border-radius: 9px;
            outline: none;
            font-family: inherit;
            font-size: 13px;
            transition: .2s ease;
        }

        .form-control::placeholder {
            color: #a1b3ac;
        }

        .form-control:focus {
            border-color: #80b89a;
            box-shadow: 0 0 0 3px rgba(91, 157, 119, .10);
        }

        textarea.form-control {
            height: auto;
            min-height: 86px;
            padding: 11px 12px;
            resize: vertical;
        }

        input[type="date"].form-control {
            color: #31544b;
        }

        .ts-wrapper {
            width: 100%;
        }

        .ts-control {
            min-height: 42px !important;
            height: 42px !important;
            padding: 0 12px !important;
            display: flex !important;
            align-items: center !important;
            color: #1d443b !important;
            background: #fff !important;
            border: 1px solid var(--input-border) !important;
            border-radius: 9px !important;
            box-shadow: none !important;
            font-size: 13px !important;
        }

        .ts-control input {
            color: #1d443b !important;
            font-size: 13px !important;
        }

        .ts-control input::placeholder {
            color: #9aada5 !important;
        }

        .ts-wrapper.focus .ts-control {
            border-color: #80b89a !important;
            box-shadow: 0 0 0 3px rgba(91, 157, 119, .10) !important;
        }

        .ts-dropdown {
            margin-top: 4px !important;
            border: 1px solid #d4e5db !important;
            border-radius: 9px !important;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(24, 67, 56, .10) !important;
            font-size: 13px !important;
        }

        .ts-dropdown .option {
            padding: 9px 12px !important;
            color: #31564c;
        }

        .ts-dropdown .option.active {
            background: #eaf5ed !important;
            color: #1e5b4d !important;
        }

        .ts-dropdown .no-results {
            padding: 10px 12px;
            color: #789087;
        }

        .measurement-box {
            padding: 17px;
            background: #fbfdfc;
            border: 1px solid #e2eee6;
            border-radius: 11px;
        }

        .measurement-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 15px;
        }

        .is-invalid {
            border-color: #d58a8a !important;
        }

        .invalid-feedback {
            display: block;
            margin-top: 5px;
            color: #b34b4b;
            font-size: 11px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 9px;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #e5eee8;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 40px;
            padding: 0 17px;
            border-radius: 9px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s ease;
        }

        .btn-cancel {
            color: #4e6b62;
            background: #f0f6f2;
            border: 1px solid #d7e6dc;
        }

        .btn-cancel:hover {
            color: #234f44;
            background: #e5f0e9;
        }

        .btn-save {
            color: #fff;
            background: #205c4f;
            border: 1px solid #205c4f;
        }

        .btn-save:hover {
            color: #fff;
            background: #194c42;
        }

        @media (max-width: 900px) {
            .measurement-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 700px) {
            .pemeriksaan-create-page {
                padding: 22px 14px 35px;
            }

            .create-header {
                align-items: flex-start;
                gap: 14px;
            }

            .create-header-left h1 {
                font-size: 22px;
            }

            .create-header-left p {
                font-size: 12px;
            }

            .btn-back {
                height: 38px;
                padding: 0 13px;
                white-space: nowrap;
            }

            .create-card-header {
                padding: 18px;
            }

            .create-card-body {
                padding: 20px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .form-group.full {
                grid-column: auto;
            }

            .measurement-grid {
                grid-template-columns: 1fr 1fr;
                gap: 13px;
            }
        }

        @media (max-width: 430px) {
            .create-header {
                flex-direction: column;
            }

            .btn-back {
                align-self: flex-start;
            }

            .measurement-grid {
                grid-template-columns: 1fr;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }
    </style>

    <div class="pemeriksaan-create-page">
        <div class="pemeriksaan-create-container">

            <div class="create-header">
                <div class="create-header-left">
                    <h1>Tambah Pemeriksaan</h1>
                    <p>Tambahkan data hasil pemeriksaan kesehatan warga.</p>
                </div>

                <a href="{{ route('pemeriksaan.index') }}" class="btn-back">
                    ← Kembali
                </a>
            </div>

            @if($errors->any())
                <div class="form-error">
                    <strong>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="create-card">
                <div class="create-card-header">
                    <h2>Data Pemeriksaan</h2>
                    <p>Lengkapi data pemeriksaan berikut dengan benar.</p>
                </div>

                <div class="create-card-body">
                    <form action="{{ route('pemeriksaan.store') }}" method="POST">
                        @csrf

                        {{-- INFORMASI PEMERIKSAAN --}}
                        <div class="form-section">
                            <div class="form-section-title">
                                Informasi Pemeriksaan
                            </div>

                            <div class="form-grid">

                                {{-- WARGA --}}
                                <div class="form-group">
                                    <label for="warga_id" class="form-label">
                                        Warga <span class="required">*</span>
                                    </label>

                                    <select name="warga_id"
                                            id="warga_id"
                                            class="@error('warga_id') is-invalid @enderror"
                                            required>
                                        <option value="">-- Pilih Warga --</option>

                                        @foreach($wargas as $warga)
                                            <option value="{{ $warga->id }}"
                                                {{ old('warga_id', $pemeriksaan->warga_id ?? '') == $warga->id ? 'selected' : '' }}>
                                                {{ $warga->nama }} - {{ $warga->nik }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('warga_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- JADWAL --}}
                                <div class="form-group">
                                    <label for="jadwal_id" class="form-label">
                                        Jadwal <span class="required">*</span>
                                    </label>

                                    <select name="jadwal_id"
                                            id="jadwal_id"
                                            class="@error('jadwal_id') is-invalid @enderror"
                                            required>
                                        <option value="">-- Pilih Jadwal --</option>

                                        @foreach($jadwals as $jadwal)
                                            <option value="{{ $jadwal->id }}"
                                                {{ old('jadwal_id', $pemeriksaan->jadwal_id ?? '') == $jadwal->id ? 'selected' : '' }}>
                                                {{ $jadwal->tanggal?->format('d/m/Y') }}
                                                -
                                                {{ $jadwal->lokasi ?? 'Lokasi tidak tersedia' }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('jadwal_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- PEMERIKSA --}}
                                <div class="form-group">
                                    <label for="pemeriksa_id" class="form-label">
                                        Pemeriksa <span class="required">*</span>
                                    </label>

                                    <select name="pemeriksa_id"
                                            id="pemeriksa_id"
                                            class="@error('pemeriksa_id') is-invalid @enderror"
                                            required>
                                        <option value="">-- Pilih Pemeriksa --</option>

                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('pemeriksa_id', $pemeriksaan->pemeriksa_id ?? '') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('pemeriksa_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- TANGGAL --}}
                                <div class="form-group">
                                    <label for="tanggal" class="form-label">
                                        Tanggal Pemeriksaan <span class="required">*</span>
                                    </label>

                                    <input type="date"
                                           name="tanggal"
                                           id="tanggal"
                                           class="form-control @error('tanggal') is-invalid @enderror"
                                           value="{{ old('tanggal', isset($pemeriksaan->tanggal) ? $pemeriksaan->tanggal->format('Y-m-d') : '') }}"
                                           required>

                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>

                        {{-- HASIL PENGUKURAN --}}
                        <div class="form-section">
                            <div class="form-section-title">
                                Hasil Pengukuran
                            </div>

                            <div class="measurement-box">
                                <div class="measurement-grid">

                                    {{-- BERAT --}}
                                    <div class="form-group">
                                        <label for="berat_badan" class="form-label">
                                            Berat Badan <span class="unit">(kg)</span>
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               name="berat_badan"
                                               id="berat_badan"
                                               class="form-control"
                                               placeholder="Contoh: 55"
                                               value="{{ old('berat_badan', $pemeriksaan->berat_badan ?? '') }}">
                                    </div>

                                    {{-- TINGGI --}}
                                    <div class="form-group">
                                        <label for="tinggi_badan" class="form-label">
                                            Tinggi Badan <span class="unit">(cm)</span>
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               name="tinggi_badan"
                                               id="tinggi_badan"
                                               class="form-control"
                                               placeholder="Contoh: 165"
                                               value="{{ old('tinggi_badan', $pemeriksaan->tinggi_badan ?? '') }}">
                                    </div>

                                    {{-- LINGKAR KEPALA --}}
                                    <div class="form-group">
                                        <label for="lingkar_kepala" class="form-label">
                                            Lingkar Kepala <span class="unit">(cm)</span>
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               name="lingkar_kepala"
                                               id="lingkar_kepala"
                                               class="form-control"
                                               placeholder="Contoh: 54"
                                               value="{{ old('lingkar_kepala', $pemeriksaan->lingkar_kepala ?? '') }}">
                                    </div>

                                    {{-- LINGKAR LENGAN --}}
                                    <div class="form-group">
                                        <label for="lingkar_lengan" class="form-label">
                                            Lingkar Lengan <span class="unit">(cm)</span>
                                        </label>

                                        <input type="number"
                                               step="0.01"
                                               name="lingkar_lengan"
                                               id="lingkar_lengan"
                                               class="form-control"
                                               placeholder="Contoh: 25"
                                               value="{{ old('lingkar_lengan', $pemeriksaan->lingkar_lengan ?? '') }}">
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- KONDISI KESEHATAN --}}
                        <div class="form-section">
                            <div class="form-section-title">
                                Kondisi Kesehatan
                            </div>

                            <div class="form-grid">

                                {{-- TEKANAN DARAH --}}
                                <div class="form-group">
                                    <label for="tekanan_darah" class="form-label">
                                        Tekanan Darah <span class="unit">(mmHg)</span>
                                    </label>

                                    <input type="text"
                                           name="tekanan_darah"
                                           id="tekanan_darah"
                                           class="form-control"
                                           placeholder="Contoh: 120/80"
                                           value="{{ old('tekanan_darah', $pemeriksaan->tekanan_darah ?? '') }}">
                                </div>

                                {{-- GULA DARAH --}}
                                <div class="form-group">
                                    <label for="gula_darah" class="form-label">
                                        Gula Darah <span class="unit">(mg/dL)</span>
                                    </label>

                                    <input type="number"
                                           step="0.01"
                                           name="gula_darah"
                                           id="gula_darah"
                                           class="form-control"
                                           placeholder="Contoh: 100"
                                           value="{{ old('gula_darah', $pemeriksaan->gula_darah ?? '') }}">
                                </div>

                                {{-- STATUS GIZI --}}
                                <div class="form-group">
                                    <label for="status_gizi" class="form-label">
                                        Status Gizi
                                    </label>

                                    <select name="status_gizi" id="status_gizi">
                                        <option value="">-- Pilih Status Gizi --</option>

                                        @foreach(['Sangat Kurus', 'Kurus', 'Normal', 'Gemuk', 'Obesitas'] as $status)
                                            <option value="{{ $status }}"
                                                {{ old('status_gizi', $pemeriksaan->status_gizi ?? '') == $status ? 'selected' : '' }}>
                                                {{ $status }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        {{-- CATATAN --}}
                        <div class="form-section">
                            <div class="form-section-title">
                                Keluhan & Catatan
                            </div>

                            <div class="form-grid">

                                <div class="form-group">
                                    <label for="keluhan" class="form-label">
                                        Keluhan
                                    </label>

                                    <textarea name="keluhan"
                                              id="keluhan"
                                              class="form-control"
                                              placeholder="Masukkan keluhan warga...">{{ old('keluhan', $pemeriksaan->keluhan ?? '') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="catatan" class="form-label">
                                        Catatan
                                    </label>

                                    <textarea name="catatan"
                                              id="catatan"
                                              class="form-control"
                                              placeholder="Tambahkan catatan pemeriksaan...">{{ old('catatan', $pemeriksaan->catatan ?? '') }}</textarea>
                                </div>

                            </div>
                        </div>

                        {{-- BUTTON --}}
                        <div class="form-actions">
                            <a href="{{ route('pemeriksaan.index') }}"
                               class="btn btn-cancel">
                                Batal
                            </a>

                            <button type="submit" class="btn btn-save">
                                Simpan Pemeriksaan
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const tomSelectConfig = {
                create: false,
                allowEmptyOption: true,
                maxOptions: 100,
                closeAfterSelect: true
            };

            new TomSelect('#warga_id', {
                ...tomSelectConfig,
                placeholder: 'Cari nama atau NIK warga...',
                searchField: ['text']
            });

            new TomSelect('#jadwal_id', {
                ...tomSelectConfig,
                placeholder: 'Cari tanggal atau lokasi jadwal...',
                searchField: ['text']
            });

            new TomSelect('#pemeriksa_id', {
                ...tomSelectConfig,
                placeholder: 'Cari nama pemeriksa...',
                searchField: ['text']
            });

            new TomSelect('#status_gizi', {
                ...tomSelectConfig,
                placeholder: 'Pilih status gizi...'
            });

        });
    </script>
</x-app-layout>