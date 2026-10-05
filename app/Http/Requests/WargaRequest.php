<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class WargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // akses dibatasi di route (middleware role)
    }

    public function rules(): array
    {
        $id = $this->route('warga')?->id; // null saat tambah, terisi saat edit

        return [
            'nik'           => ['required', 'digits:16', Rule::unique('wargas', 'nik')->ignore($id)->whereNull('deleted_at')],
            'nama'          => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'alamat'        => ['required', 'string'],
            'rt_rw'         => ['required', 'string', 'max:10'],
            'kategori'      => ['nullable', Rule::in(['balita', 'ibu_hamil', 'remaja', 'dewasa', 'lansia'])],
            'nama_wali'     => ['nullable', 'string', 'max:255'],
            'no_hp'         => ['nullable', 'regex:/^[0-9+]{8,20}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'nik.required'                  => 'NIK wajib diisi.',
            'nik.digits'                    => 'NIK harus 16 digit angka.',
            'nik.unique'                    => 'NIK sudah terdaftar.',
            'nama.required'                 => 'Nama wajib diisi.',
            'tanggal_lahir.required'        => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir tidak boleh melebihi hari ini.',
            'jenis_kelamin.required'        => 'Jenis kelamin wajib diisi.',
            'jenis_kelamin.in'              => 'Jenis kelamin harus L atau P.',
            'alamat.required'               => 'Alamat wajib diisi.',
            'rt_rw.required'                => 'RT/RW wajib diisi.',
            'kategori.in'                   => 'Kategori tidak valid.',
            'no_hp.regex'                   => 'Nomor HP tidak valid (8-20 digit).',
        ];
    }
}