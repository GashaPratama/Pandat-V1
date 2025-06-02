<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institusi;
use OpenApi\Annotations as OA;


class InstitusiController extends Controller
{
    /**
     * @OA\Get(
     *     path="/institusi",
     *     security={{"sanctum":{}}},
     *     summary="Menampilkan semua institusi",
     *     tags={"Institusi"},
     *     @OA\Response(
     *         response=200, 
     *         description="Berhasil mengambil data",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nama_institusi", type="string", example="Politeknik XYZ"),
     *                 @OA\Property(property="alamat", type="string", example="Jl. Merdeka No.123"),
     *                 @OA\Property(property="kontak", type="string", example="08123456789"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Institusi::all());
    }

    /**
     * @OA\Post(
     *     path="/institusi",
     *     security={{"sanctum":{}}},
     *     summary="Menambahkan institusi baru",
     *     tags={"Institusi"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_institusi","alamat","kontak"},
     *             @OA\Property(property="nama_institusi", type="string", example="Politeknik XYZ"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Merdeka No.123"),
     *             @OA\Property(property="kontak", type="string", example="08123456789")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201, 
     *         description="Data berhasil disimpan",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nama_institusi", type="string", example="Politeknik XYZ"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Merdeka No.123"),
     *             @OA\Property(property="kontak", type="string", example="08123456789"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422, 
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="nama_institusi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Nama institusi harus diisi.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_institusi' => 'required|string|max:100',
            'alamat' => 'required|string|max:255',
            'kontak' => 'required|string|max:100',
        ]);

        $institusi = Institusi::create($validated);
        return response()->json($institusi, 201);
    }

    /**
     * @OA\Get(
     *     path="/institusi/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Menampilkan detail institusi berdasarkan ID",
     *     tags={"Institusi"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID dari institusi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200, 
     *         description="Data ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nama_institusi", type="string", example="Politeknik XYZ"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Merdeka No.123"),
     *             @OA\Property(property="kontak", type="string", example="08123456789"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404, 
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Institusi] 1")
     *         )
     *     )
     * )
     */
    public function show($id)
    {
        $institusi = Institusi::findOrFail($id);
        return response()->json($institusi);
    }

    /**
     * @OA\Put(
     *     path="/institusi/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Mengupdate institusi berdasarkan ID",
     *     tags={"Institusi"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID dari institusi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_institusi", type="string", example="Universitas A"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Sudirman"),
     *             @OA\Property(property="kontak", type="string", example="081299988877")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200, 
     *         description="Data berhasil diupdate",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="nama_institusi", type="string", example="Universitas A"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Sudirman"),
     *             @OA\Property(property="kontak", type="string", example="081299988877"),
     *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-17T14:30:00.000000Z"),
     *             @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-17T14:35:00.000000Z")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404, 
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Institusi] 1")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422, 
     *         description="Validasi gagal",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\Property(
     *                     property="nama_institusi",
     *                     type="array",
     *                     @OA\Items(type="string", example="Nama institusi terlalu panjang.")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $institusi = Institusi::findOrFail($id);

        $validated = $request->validate([
            'nama_institusi' => 'sometimes|required|string|max:100',
            'alamat' => 'sometimes|required|string|max:255',
            'kontak' => 'sometimes|required|string|max:100',
        ]);

        $institusi->update($validated);
        return response()->json($institusi);
    }

    /**
     * @OA\Delete(
     *     path="/institusi/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Menghapus institusi berdasarkan ID",
     *     tags={"Institusi"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID dari institusi",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204, 
     *         description="Data berhasil dihapus"
     *     ),
     *     @OA\Response(
     *         response=404, 
     *         description="Data tidak ditemukan",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Institusi] 1")
     *         )
     *     )
     * )
     */
    public function destroy($id)
    {
        $institusi = Institusi::findOrFail($id);
        $institusi->delete();

        return response()->json(null, 204);
    }
}