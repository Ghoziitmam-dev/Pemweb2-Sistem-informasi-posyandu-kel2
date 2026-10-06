<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class JadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // akses dibatasi di route (role:admin,kader)
    }

    public function rules(): array
    {
        $kegiatan = Rule::exists('kegiatans', 'id');
        if ($this->isMethod('POST')) {
            $kegiatan->where('status', 'aktif');
        }

        return [
            'kegiatan_id' => ['required', $kegiatan],
            'tanggal' => ['required', 'date', 'after_or_equal:today'],
            'jam_mulai' => ['required', 'date_format:H:i'],
            'jam_selesai' => ['required', 'date_format:H:i', 'after:jam_mulai'],
            'lokasi' => ['required', 'string', 'max:255'],
            'petugas' => ['nullable', 'string', 'max:255'],
            'kuota' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'tanggal.after_or_equal' => 'Tanggal tidak boleh di masa lalu.',
            'jam_selesai.after' => 'Jam selesai harus setelah jam mulai.',
            'kegiatan_id.exists' => 'Kegiatan tidak ditemukan atau tidak aktif.',
        ];
    }

    public function after(): array
    {
        return [function ($validator) {
            $jadwal = $this->route('jadwal');

            if ($jadwal && $this->filled('kuota')) {
                $terisi = $jadwal->pendaftarans()
                    ->whereIn('status', \App\Models\Pendaftaran::AKTIF)->count();

                if ($this->integer('kuota') < $terisi) {
                    $validator->errors()->add(
                        'kuota',
                        "Kuota tidak boleh kurang dari jumlah peserta saat ini ({$terisi})."
                    );
                }
            }
        }];
    }
}