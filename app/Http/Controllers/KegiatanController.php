<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::paginate(10);

        return view('kegiatan.index', [
            'kegiatans' => $kegiatans,
            'statuses' => [
                'aktif' => 'Aktif',
                'nonaktif' => 'Nonaktif',
            ],
        ]);
    }


    public function create()
    {
        return view('kegiatan.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'target_peserta' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);


        // Upload foto
        if ($request->hasFile('foto')) {

            $data['foto'] = $request->file('foto')
                ->store('kegiatan', 'public');

        }


        Kegiatan::create($data);


        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }


    public function show(Kegiatan $kegiatan)
    {
        return view('kegiatan.show', compact('kegiatan'));
    }


    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }


    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'jenis' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'target_peserta' => ['nullable', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);



        // Jika upload foto baru
        if ($request->hasFile('foto')) {


            // hapus foto lama
            if ($kegiatan->foto) {

                Storage::disk('public')
                    ->delete($kegiatan->foto);

            }


            // simpan foto baru
            $data['foto'] = $request->file('foto')
                ->store('kegiatan', 'public');

        }



        $kegiatan->update($data);



        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }


    public function destroy(Kegiatan $kegiatan)
    {

        // hapus file foto saat kegiatan dihapus
        if ($kegiatan->foto) {

            Storage::disk('public')
                ->delete($kegiatan->foto);

        }


        $kegiatan->delete();


        return redirect()
            ->route('kegiatan.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}