<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Senjata;
use App\Models\JenisSenjata;
use App\Models\Gudang;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class SenjataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/senjata",
     *     summary="Menampilkan semua senjata",
     *     tags={"Senjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Data senjata ditemukan"
     *     )
     * )
     */
    public function index()
    {
        $senjatas = Senjata::with(['jenis', 'gudang'])->get();
        return response()->json([
            'status' => 200,
            'message' => "Data senjata ditemukan",
            'data' => $senjatas
        ]);
    }

    /**
     * @OA\Post(
     *     path="/senjata",
     *     summary="Menyimpan senjata baru",
     *     tags={"Senjata"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_senjata", "id_jenis", "id_gudang", "stok", "kaliber", "nomor_seri"},
     *             @OA\Property(property="nama_senjata", type="string"),
     *             @OA\Property(property="id_jenis", type="integer"),
     *             @OA\Property(property="id_gudang", type="integer"),
     *             @OA\Property(property="stok", type="integer"),
     *             @OA\Property(property="kaliber", type="string"),
     *             @OA\Property(property="nomor_seri", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Senjata berhasil dibuat"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Terjadi kesalahan saat menyimpan data"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "nama_senjata" => "required|string|max:100",
                "id_jenis" => "required|exists:jenis_senjata,id_jenis",
                "id_gudang" => "required|exists:gudangs,id_gudang",
                "stok" => "required|integer|min:0",
                "kaliber" => "required|string|max:50",
                "nomor_seri" => "required|string|max:100|unique:senjatas,nomor_seri",
            ]);

            $senjata = Senjata::create($validatedData);

            return response()->json([
                'status' => 201,
                "message" => "Senjata berhasil dibuat",
                "data" => $senjata
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                "message" => "Terjadi kesalahan saat menyimpan data",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/senjata/{id}",
     *     summary="Menampilkan senjata berdasarkan ID",
     *     tags={"Senjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Senjata berhasil ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Senjata tidak ditemukan"
     *     )
     * )
     */
    public function show(string $id)
    {
        $senjata = Senjata::with(['jenis', 'gudang'])->find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil ditemukan",
            "data" => $senjata
        ]);
    }

    /**
     * @OA\Put(
     *     path="/senjata/{id}",
     *     summary="Mengupdate senjata berdasarkan ID",
     *     tags={"Senjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_senjata", "id_jenis", "id_gudang", "stok", "kaliber", "nomor_seri"},
     *             @OA\Property(property="nama_senjata", type="string"),
     *             @OA\Property(property="id_jenis", type="integer"),
     *             @OA\Property(property="id_gudang", type="integer"),
     *             @OA\Property(property="stok", type="integer"),
     *             @OA\Property(property="kaliber", type="string"),
     *             @OA\Property(property="nomor_seri", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Senjata berhasil diupdate"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Senjata tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $senjata = Senjata::find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        $validatedData = $request->validate([
            "nama_senjata" => "required|string|max:100",
            "id_jenis" => "required|exists:jenis_senjatas,id_jenis",
            "id_gudang" => "required|exists:gudangs,id_gudang",
            "stok" => "required|integer|min:0",
            "kaliber" => "required|string|max:50",
            "nomor_seri" => [
                "required",
                "string",
                "max:100",
                Rule::unique('senjatas', 'nomor_seri')->ignore($id, 'id_senjata')
            ],
        ]);

        $senjata->update($validatedData);

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil diupdate",
            "data" => $senjata
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/senjata/{id}",
     *     summary="Menghapus senjata berdasarkan ID",
     *     tags={"Senjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Senjata berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Senjata tidak ditemukan"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $senjata = Senjata::find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        $senjata->delete();

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil dihapus"
        ]);
    }
}
