<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeralatanResource;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeralatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peralatan::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('brand', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('harga_min')) {
            $query->where('harga_sewa', '>=', $request->harga_min);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga_sewa', '<=', $request->harga_max);
        }

        $sortBy = $request->query('sort_by', 'created_at');
        $sortDirection = $request->query('sort_direction', 'desc');

        if (! in_array($sortBy, ['nama', 'harga_sewa', 'stok', 'created_at'])) {
            $sortBy = 'created_at';
        }

        if (! in_array($sortDirection, ['asc', 'desc'])) {
            $sortDirection = 'desc';
        }

        $perPage = max(1, min($request->integer('per_page', 10), 100));

        $peralatan = $query
            ->orderBy($sortBy, $sortDirection)
            ->paginate($perPage)
            ->withQueryString();

        return response()->json([
            'message' => 'Data peralatan berhasil diambil',
            'data' => PeralatanResource::collection($peralatan->getCollection()),
            'meta' => [
                'current_page' => $peralatan->currentPage(),
                'last_page' => $peralatan->lastPage(),
                'per_page' => $peralatan->perPage(),
                'total' => $peralatan->total(),
            ],
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'brand' => ['required', 'string', 'max:255'],
            'kategori' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'harga_sewa' => ['required', 'numeric', 'min:0'],
            'stok' => ['required', 'integer', 'min:0'],
            'kondisi' => [
                'required',
                Rule::in(['baru', 'baik', 'perlu_perbaikan']),
            ],
            'status' => [
                'required',
                Rule::in(['tersedia', 'tidak_tersedia']),
            ],
        ]);

        $peralatan = Peralatan::create($validated);

        return response()->json([
            'message' => 'Peralatan berhasil ditambahkan',
            'data' => new PeralatanResource($peralatan),
        ], 201);
    }

    public function show(Peralatan $peralatan)
    {
        return response()->json([
            'message' => 'Detail peralatan berhasil diambil',
            'data' => new PeralatanResource($peralatan),
        ]);
    }

    public function update(Request $request, Peralatan $peralatan)
    {
        $validated = $request->validate([
            'nama' => ['sometimes', 'required', 'string', 'max:255'],
            'brand' => ['sometimes', 'required', 'string', 'max:255'],
            'kategori' => ['sometimes', 'required', 'string', 'max:255'],
            'deskripsi' => ['sometimes', 'nullable', 'string'],
            'harga_sewa' => ['sometimes', 'required', 'numeric', 'min:0'],
            'stok' => ['sometimes', 'required', 'integer', 'min:0'],
            'kondisi' => [
                'sometimes',
                'required',
                Rule::in(['baru', 'baik', 'perlu_perbaikan']),
            ],
            'status' => [
                'sometimes',
                'required',
                Rule::in(['tersedia', 'tidak_tersedia']),
            ],
        ]);

        $peralatan->update($validated);

        return response()->json([
            'message' => 'Peralatan berhasil diperbarui',
            'data' => new PeralatanResource($peralatan->fresh()),
        ]);
    }

    public function destroy(Peralatan $peralatan)
    {
        $peralatan->delete();

        return response()->json([
            'message' => 'Peralatan berhasil dihapus',
            'data' => null,
        ]);
    }
}
