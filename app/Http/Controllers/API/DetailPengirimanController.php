<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailPengiriman;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="DetailPengiriman",
 *     type="object",
 *     required={"id_pengiriman", "id_senjata", "jumlah", "created_at"},
 *     @OA\Property(property="id_detail_pengiriman", type="integer", example=1),
 *     @OA\Property(property="id_pengiriman", type="integer", example=1001),
 *     @OA\Property(property="id_senjata", type="integer", example=2002),
 *     @OA\Property(property="jumlah", type="integer", example=10),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-15T10:00:00Z")
 * )
 */

class DetailPengirimanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/detail-pengiriman",
     *     tags={"DetailPengiriman"},
     *     summary="Menampilkan semua detail pengiriman",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Data ditemukan",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/DetailPengiriman"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(DetailPengiriman::all());
    }

    /**
     * @OA\Post(
     *     path="/detail-pengiriman",
     *     tags={"DetailPengiriman"},
     *     summary="Menambahkan data detail pengiriman",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_pengiriman","id_senjata","jumlah","created_at"},
     *             @OA\Property(property="id_pengiriman", type="integer"),
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="created_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data berhasil disimpan",
     *         @OA\JsonContent(ref="#/components/schemas/DetailPengiriman")
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'id_pengiriman' => 'required|integer|exists:pengiriman,id_pengiriman',
                'id_senjata' => 'required|integer|exists:senjata,id_senjata',
                'jumlah' => 'required|integer|min:1',
                'created_at' => 'required|date'
            ]);

            $detail = DetailPengiriman::create($data);

            return response()->json([
                'status' => 'success',
                'message' => 'Data detail pengiriman berhasil disimpan',
                'data' => $detail
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/detail-pengiriman/{id}",
     *     tags={"DetailPengiriman"},
     *     summary="Mengupdate data detail pengiriman",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_pengiriman","id_senjata","jumlah","created_at"},
     *             @OA\Property(property="id_pengiriman", type="integer"),
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="created_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data berhasil diupdate",
     *         @OA\JsonContent(ref="#/components/schemas/DetailPengiriman")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'id_pengiriman' => 'required|integer|exists:pengiriman,id_pengiriman',
            'id_senjata' => 'required|integer|exists:senjata,id_senjata',
            'jumlah' => 'required|integer|min:1',
            'created_at' => 'required|date'
        ]);

        $detail = DetailPengiriman::find($id);
        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detail->update($data);

        return response()->json($detail);
    }

    /**
     * @OA\Delete(
     *     path="/detail-pengiriman/{id}",
     *     tags={"DetailPengiriman"},
     *     summary="Menghapus data detail pengiriman",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $detail = DetailPengiriman::find($id);
        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detail->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    /**
     * @OA\Get(
     *     path="/detail-pengiriman/{id}",
     *     tags={"DetailPengiriman"},
     *     summary="Menampilkan detail pengiriman berdasarkan ID",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data ditemukan",
     *         @OA\JsonContent(ref="#/components/schemas/DetailPengiriman")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
    {
        $detail = DetailPengiriman::find($id);
        if (!$detail) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($detail);
    }
}

