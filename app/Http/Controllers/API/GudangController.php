<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Pandat V1 API",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk endpoint Warehouse Mannagement System Pandat"
 * )
 */
class GudangController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/gudang",
     *     summary="Tampilkan semua gudang",
     *     tags={"Gudang"},
     *     @OA\Response(
     *         response=200,
     *         description="Data gudang ditemukan"
     *     )
     * )
     */
    public function index()
    {
        $gudangs = Gudang::all();
        return response()->json([
            'status' => 200,
            'message' => "Data gudang ditemukan",
            'data' => $gudangs
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/gudang",
     *     summary="Tambah gudang baru",
     *     tags={"Gudang"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_gudang", "alamat", "kota"},
     *             @OA\Property(property="nama_gudang", type="string"),
     *             @OA\Property(property="alamat", type="string"),
     *             @OA\Property(property="kota", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Gudang berhasil dibuat"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_gudang" => "required|unique:gudangs",
            "alamat" => "required|string",
            "kota" => "required|string",
        ]);

        $gudang = Gudang::create($validatedData);

        return response()->json([
            'status' => 201,
            "message" => "Gudang berhasil dibuat",
            "data" => $gudang
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/gudang/{id}",
     *     summary="Tampilkan gudang berdasarkan ID",
     *     tags={"Gudang"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gudang berhasil ditemukan"
     *     )
     * )
     */
    public function show(string $id)
    {
        $gudang = Gudang::findOrFail($id);

        return response()->json([
            'status' => 200,
            "message" => "Gudang berhasil ditemukan",
            "data" => $gudang
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/gudang/{id}",
     *     summary="Update gudang berdasarkan ID",
     *     tags={"Gudang"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama_gudang", "alamat", "kota"},
     *             @OA\Property(property="nama_gudang", type="string"),
     *             @OA\Property(property="alamat", type="string"),
     *             @OA\Property(property="kota", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gudang berhasil diupdate"
     *     )
     * )
     */
    public function update(Request $request, string $id)
    {
        $gudang = Gudang::findOrFail($id);

        $validatedData = $request->validate([
            "nama_gudang" => "required|string",
            "alamat" => "required|string",
            "kota" => "required|string",
        ]);

        $gudang->update($validatedData);

        return response()->json([
            'status' => 200,
            "message" => "Gudang berhasil diupdate",
            "data" => $gudang
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/gudang/{id}",
     *     summary="Hapus gudang berdasarkan ID",
     *     tags={"Gudang"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Gudang berhasil dihapus"
     *     )
     * )
     */
    public function destroy(string $id)
    {
        $gudang = Gudang::findOrFail($id);
        $gudang->delete();

        return response()->json([
            'status' => 200,
            "message" => "Gudang berhasil dihapus"
        ]);
    }
}
