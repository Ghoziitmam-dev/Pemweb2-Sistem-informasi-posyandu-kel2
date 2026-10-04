@php $jadwal = $jadwal ?? new \App\Models\Jadwal; @endphp

<div class="space-y-4">
    <div>
        <x-input-label for="kegiatan_id" value="Kegiatan" />
        <select id="kegiatan_id" name="kegiatan_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            <option value="">-- Pilih kegiatan --</option>
            @foreach ($kegiatans as $k)
                <option value="{{ $k->id }}" @selected(old('kegiatan_id', $jadwal->kegiatan_id) == $k->id)>{{ $k->judul }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('kegiatan_id')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="tanggal" value="Tanggal" />
        <x-text-input id="tanggal" name="tanggal" type="date" class="mt-1 block w-full"
            :value="old('tanggal', $jadwal->tanggal?->format('Y-m-d'))" required />
        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <x-input-label for="jam_mulai" value="Jam Mulai" />
            <x-text-input id="jam_mulai" name="jam_mulai" type="time" class="mt-1 block w-full"
                :value="old('jam_mulai', $jadwal->jam_mulai ? substr($jadwal->jam_mulai, 0, 5) : '')" required />
            <x-input-error :messages="$errors->get('jam_mulai')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="jam_selesai" value="Jam Selesai" />
            <x-text-input id="jam_selesai" name="jam_selesai" type="time" class="mt-1 block w-full"
                :value="old('jam_selesai', $jadwal->jam_selesai ? substr($jadwal->jam_selesai, 0, 5) : '')" required />
            <x-input-error :messages="$errors->get('jam_selesai')" class="mt-2" />
        </div>
    </div>

    <div>
        <x-input-label for="lokasi" value="Lokasi" />
        <x-text-input id="lokasi" name="lokasi" type="text" class="mt-1 block w-full"
            :value="old('lokasi', $jadwal->lokasi)" required />
        <x-input-error :messages="$errors->get('lokasi')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="petugas" value="Petugas (opsional)" />
        <x-text-input id="petugas" name="petugas" type="text" class="mt-1 block w-full"
            :value="old('petugas', $jadwal->petugas)" />
        <x-input-error :messages="$errors->get('petugas')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="status" value="Status" />
        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            @foreach ($statuses as $key => $label)
                <option value="{{ $key }}" @selected(old('status', $jadwal->status ?? 'akan_datang') === $key)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>
</div>