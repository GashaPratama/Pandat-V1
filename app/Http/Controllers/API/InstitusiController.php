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
     *     path="/api/institusi",
     *     summary="Menampilkan semua institusi",
     *     tags={"Institusi"},
     *     @OA\Response(response=200, description="Berhasil mengambil data")
     * )
     */
    public function index()
    {
        return response()->json(Institusi::all());
    }

    /**
     * @OA\Post(
     *     path="/api/institusi",
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
     *     @OA\Response(response=201, description="Data berhasil disimpan")
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
     *     path="/api/institusi/{id}",
     *     summary="Menampilkan detail institusi berdasarkan ID",
     *     tags={"Institusi"},
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
        $institusi = Institusi::findOrFail($id);
        return response()->json($institusi);
    }

    /**
     * @OA\Put(
     *     path="/api/institusi/{id}",
     *     summary="Mengupdate institusi berdasarkan ID",
     *     tags={"Institusi"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             @OA\Property(property="nama_institusi", type="string", example="Universitas A"),
     *             @OA\Property(property="alamat", type="string", example="Jl. Sudirman"),
     *             @OA\Property(property="kontak", type="string", example="081299988877")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Data berhasil diupdate")
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
     *     path="/api/institusi/{id}",
     *     summary="Menghapus institusi berdasarkan ID",
     *     tags={"Institusi"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Data berhasil dihapus")
     * )
     */
    public function destroy($id)
    {
        $institusi = Institusi::findOrFail($id);
        $institusi->delete();

        return response()->json(null, 204);
    }
}

