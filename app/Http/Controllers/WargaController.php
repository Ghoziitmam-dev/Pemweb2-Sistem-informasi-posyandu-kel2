<?php

namespace App\Http\Controllers;

use App\Http\Requests\WargaRequest;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WargaController extends Controller
{
    protected array $kategoris = [
        'balita' => 'Balita',
        'ibu_hamil' => 'Ibu Hamil',
        'remaja' => 'Remaja',
        'dewasa' => 'Dewasa',
        'lansia' => 'Lansia',
    ];

    public function index(Request $request): View
    {
        $wargas = Warga::search($request->query('search'))
            ->when($request->query('kategori'), fn ($q, $k) => $q->where('kategori', $k))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $stats = [
            'total' => Warga::count(),
            'balita' => Warga::where('kategori', 'balita')->count(),
            'ibu_hamil' => Warga::where('kategori', 'ibu_hamil')->count(),
            'lansia' => Warga::where('kategori', 'lansia')->count(),
        ];

        return view('warga.index', [
            'wargas' => $wargas,
            'kategoris' => $this->kategoris,
            'stats' => $stats,
        ]);
    }

    public function create(): View
    {
        return view('warga.create', ['kategoris' => $this->kategoris]);
    }

    public function store(WargaRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['kategori'])) {
            $data['kategori'] = Warga::hitungKategori($data['tanggal_lahir']);
        }

        Warga::create($data);

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga): View
    {
        return view('warga.show', compact('warga'));
    }

    public function edit(Warga $warga): View
    {
        return view('warga.edit', [
            'warga' => $warga,
            'kategoris' => $this->kategoris,
        ]);
    }

    public function update(WargaRequest $request, Warga $warga): RedirectResponse
    {
        $data = $request->validated();

        if (empty($data['kategori'])) {
            $data['kategori'] = $warga->kategori === 'ibu_hamil'
                ? 'ibu_hamil'
                : Warga::hitungKategori($data['tanggal_lahir']);
        }

        $warga->update($data);

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga): RedirectResponse
    {
        $warga->delete();

        return redirect()
            ->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}