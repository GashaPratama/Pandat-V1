<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\JenisSenjata;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="JenisSenjata",
 *     description="JenisSenjata"
 * )
 */
class JenisSenjataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/jenissenjata",
     *     summary="Menampilkan seluruh data jenis senjata",
     *     tags={"JenisSenjata"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menampilkan semua jenis senjata"
     *     )
     * )
     */
    public function index()
    {
        $jenisSenjata = JenisSenjata::all();

        return response()->json([
            'status' => 200,
            'message' => 'Data jenis senjata ditemukan',
            'data' => $jenisSenjata
        ]);
    }

    /**
     * @OA\Post(
     *     path="/jenissenjata",
     *     summary="Membuat jenis senjata baru",
     *     tags={"JenisSenjata"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_jenis"},
     *             @OA\Property(property="nama_jenis", type="string", maxLength=100),
     *             @OA\Property(property="deskripsi", type="string", maxLength=255)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Jenis senjata berhasil dibuat"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validasi gagal"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis' => 'required|unique:jenis_senjata|max:100',
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $jenisSenjata = JenisSenjata::create($validatedData);

        return response()->json([
            'status' => 201,
            'message' => 'Jenis senjata berhasil dibuat',
            'data' => $jenisSenjata
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/jenissenjata/{id}",
     *     summary="Menampilkan detail jenis senjata berdasarkan ID",
     *     tags={"JenisSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Data jenis senjata ditemukan"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis senjata tidak ditemukan"
     *     )
     * )
     */
    public function show(string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                'message' => 'Jenis senjata tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Jenis senjata berhasil ditemukan',
            'data' => $jenisSenjata
        ]);
    }

    /**
     * @OA\Put(
     *     path="/jenissenjata/{id}",
     *     summary="Mengubah data jenis senjata berdasarkan ID",
     *     tags={"JenisSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_jenis"},
     *             @OA\Property(property="nama_jenis", type="string", maxLength=100),
     *             @OA\Property(property="deskripsi", type="string", maxLength=255)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jenis senjata berhasil diperbarui"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis senjata tidak ditemukan"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                'message' => 'Jenis senjata tidak ditemukan'
            ], 404);
        }

        $validatedData = $request->validate([
            'nama_jenis' => [
                'required',
                'max:100',
                Rule::unique('jenis_senjata', 'nama_jenis')->ignore($id, 'id_jenis')
            ],
            'deskripsi' => 'nullable|string|max:255',
        ]);

        $jenisSenjata->update($validatedData);

        return response()->json([
            'status' => 200,
            'message' => 'Jenis senjata berhasil diperbarui',
            'data' => $jenisSenjata
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/jenissenjata/{id}",
     *     summary="Menghapus jenis senjata berdasarkan ID",
     *     tags={"JenisSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jenis senjata berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jenis senjata tidak ditemukan"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                'message' => 'Jenis senjata tidak ditemukan'
            ], 404);
        }

        $jenisSenjata->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Jenis senjata berhasil dihapus'
        ]);
    }
}
