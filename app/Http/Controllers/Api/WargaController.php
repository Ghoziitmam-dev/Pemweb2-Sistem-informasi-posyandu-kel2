<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\WargaRequest;
use App\Http\Resources\WargaResource;
use App\Models\Warga;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WargaController extends Controller
{
    // READ: ?search=budi&kategori=balita&per_page=10
    public function index(Request $request): AnonymousResourceCollection
    {
        $perPage = min(max((int) $request->query('per_page', 10), 1), 100);

        $warga = Warga::search($request->query('search'))
            ->when($request->query('kategori'), fn ($q, $k) => $q->where('kategori', $k))
            ->orderBy('nama')
            ->paginate($perPage)
            ->withQueryString();

        return WargaResource::collection($warga)->additional([
            'success' => true,
            'message' => 'Daftar data warga.',
        ]);
    }

    // CREATE
    public function store(WargaRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['kategori'] ??= Warga::hitungKategori($data['tanggal_lahir']);

        $warga = Warga::create($data);

        return (new WargaResource($warga))
            ->additional(['success' => true, 'message' => 'Data warga berhasil ditambahkan.'])
            ->response()
            ->setStatusCode(201);
    }

    // READ: detail
    public function show(Warga $warga): WargaResource
    {
        return (new WargaResource($warga))
            ->additional(['success' => true, 'message' => 'Detail data warga.']);
    }

    // UPDATE
    public function update(WargaRequest $request, Warga $warga): WargaResource
    {
        $data = $request->validated();

        if (empty($data['kategori'])) {
            $data['kategori'] = $warga->kategori === 'ibu_hamil'
                ? 'ibu_hamil'
                : Warga::hitungKategori($data['tanggal_lahir']);
        }

        $warga->update($data);

        return (new WargaResource($warga))
            ->additional(['success' => true, 'message' => 'Data warga berhasil diperbarui.']);
    }

    // DELETE (soft delete)
    public function destroy(Warga $warga): JsonResponse
    {
        $warga->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data warga berhasil dihapus.',
        ]);
    }
}