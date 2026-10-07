@php
    $warga = $warga ?? null;
    $input = 'mt-1 w-full rounded-lg border border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500';
    $label = 'block text-sm font-medium text-slate-700';
@endphp

<div class="grid gap-5 md:grid-cols-2">

    <div>
        <label class="{{ $label }}">NIK</label>
        <input type="text"
               name="nik"
               inputmode="numeric"
               maxlength="16"
               class="{{ $input }}"
               value="{{ old('nik', $warga->nik ?? '') }}">
        @error('nik') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">Nama Lengkap</label>
        <input type="text"
               name="nama"
               class="{{ $input }}"
               value="{{ old('nama', $warga->nama ?? '') }}">
        @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">Tanggal Lahir</label>
        <input type="date"
               name="tanggal_lahir"
               class="{{ $input }}"
               value="{{ old('tanggal_lahir', isset($warga->tanggal_lahir) ? $warga->tanggal_lahir->format('Y-m-d') : '') }}">
        @error('tanggal_lahir') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">Jenis Kelamin</label>
        <select name="jenis_kelamin" class="{{ $input }}">
            <option value="L" @selected(old('jenis_kelamin', $warga->jenis_kelamin ?? '') === 'L')>Laki-laki</option>
            <option value="P" @selected(old('jenis_kelamin', $warga->jenis_kelamin ?? '') === 'P')>Perempuan</option>
        </select>
        @error('jenis_kelamin') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:col-span-2">
        <label class="{{ $label }}">Alamat</label>
        <textarea name="alamat" rows="2" class="{{ $input }}">{{ old('alamat', $warga->alamat ?? '') }}</textarea>
        @error('alamat') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">RT/RW</label>
        <input type="text"
               name="rt_rw"
               maxlength="10"
               placeholder="Contoh: 01/02"
               class="{{ $input }}"
               value="{{ old('rt_rw', $warga->rt_rw ?? '') }}">
        @error('rt_rw') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">Kategori</label>
        <select name="kategori" class="{{ $input }}">
            <option value="">Otomatis (dari umur)</option>
            @foreach ($kategoris as $key => $labelOption)
                <option value="{{ $key }}" @selected(old('kategori', $warga->kategori ?? '') === $key)>
                    {{ $labelOption }}
                </option>
            @endforeach
        </select>
        @error('kategori') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
        <p class="mt-1 text-xs text-slate-400">Kosongkan agar dihitung otomatis dari tanggal lahir. Pilih "Ibu Hamil" secara manual bila perlu.</p>
    </div>

    <div>
        <label class="{{ $label }}">Nama Wali (opsional)</label>
        <input type="text"
               name="nama_wali"
               class="{{ $input }}"
               value="{{ old('nama_wali', $warga->nama_wali ?? '') }}">
        @error('nama_wali') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="{{ $label }}">No. HP (opsional)</label>
        <input type="text"
               name="no_hp"
               inputmode="tel"
               maxlength="20"
               class="{{ $input }}"
               value="{{ old('no_hp', $warga->no_hp ?? '') }}">
        @error('no_hp') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

</div>