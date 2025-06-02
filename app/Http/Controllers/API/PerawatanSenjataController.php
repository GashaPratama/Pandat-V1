<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PerawatanSenjata;

class PerawatanSenjataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/perawatan",
     *     security={{"sanctum":{}}},
     *     summary="Ambil semua data perawatan senjata",
     *     tags={"PerawatanSenjata"},
     *     @OA\Response(
     *         response=200,
     *         description="Sukses mengambil data"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(PerawatanSenjata::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/perawatan",
     *     security={{"sanctum":{}}},
     *     summary="Tambah data perawatan senjata",
     *     tags={"PerawatanSenjata"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_senjata","tanggal_perawatan","jenis_perawatan","teknisi"},
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="tanggal_perawatan", type="string", format="date-time"),
     *             @OA\Property(property="jenis_perawatan", type="string"),
     *             @OA\Property(property="teknisi", type="string")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Berhasil ditambahkan")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_senjata' => 'required|integer',
            'tanggal_perawatan' => 'required|date',
            'jenis_perawatan' => 'required|string|max:100',
            'teknisi' => 'required|string|max:100',
        ]);

        $perawatan = PerawatanSenjata::create($data);
        return response()->json($perawatan, 201);
    }

    /**
     * @OA\Get(
     *     path="/perawatan/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Ambil detail perawatan berdasarkan ID",
     *     tags={"PerawatanSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Data ditemukan"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $data = PerawatanSenjata::find($id);
        return $data ? response()->json($data, 200) : response()->json(['message' => 'Tidak ditemukan'], 404);
    }

    /**
     * @OA\Put(
     *     path="/perawatan/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Perbarui data perawatan senjata",
     *     tags={"PerawatanSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="tanggal_perawatan", type="string", format="date-time"),
     *             @OA\Property(property="jenis_perawatan", type="string"),
     *             @OA\Property(property="teknisi", type="string")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Data diperbarui"),
     *     @OA\Response(response=404, description="Data tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        $perawatan = PerawatanSenjata::find($id);
        if (!$perawatan) {
            return response()->json(['message' => 'Tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_senjata' => 'required|integer',
            'tanggal_perawatan' => 'required|date',
            'jenis_perawatan' => 'required|string|max:100',
            'teknisi' => 'required|string|max:100',
        ]);

        $perawatan->update($data);
        return response()->json($perawatan, 200);
    }

    /**
     * @OA\Delete(
     *     path="/perawatan/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Hapus data perawatan senjata",
     *     tags={"PerawatanSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Berhasil dihapus"),
     *     @OA\Response(response=404, description="Tidak ditemukan")
     * )
     */
    public function destroy($id)
    {
        $perawatan = PerawatanSenjata::find($id);
        if (!$perawatan) {
            return response()->json(['message' => 'Tidak ditemukan'], 404);
        }

        $perawatan->delete();
        return response()->json(null, 204);
    }
}
