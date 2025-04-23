<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisSenjata;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; // Tambahkan Rule untuk validasi lebih aman
use OpenApi\Annotations as OA;


/**
 * @OA\Info(
 *     title="Jenis Senjata API",
 *     version="1.0.0",
 *     description="Dokumentasi API untuk manajemen jenis senjata"
 * )
 */
class JenisSenjataController extends Controller
{
   /**
     * @OA\Get(
     *     path="/api/jenissenjata",
     *     summary="Tampilkan semua Jenis Senjata",
     *     tags={"JeisSenjata"},
     *     @OA\Response(
     *         response=200,
     *         description="Data Jenis ditemukan"
     *     )
     * )
     */
    public function index()
    {
        $jenisSenjata = JenisSenjata::all();
        return response()->json([
            'status' => 200,
            'message' => "Data jenis senjata ditemukan",
            'data' => $jenisSenjata
        ]);
    }

    /**
     * Menyimpan jenis senjata baru.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "nama_jenis" => "required|unique:jenis_senjata|max:100", // Pastikan tabel sesuai
            "deskripsi" => "nullable|string|max:255",
        ]);

        $jenisSenjata = JenisSenjata::create($validatedData);

        return response()->json([
            'status' => 201,
            "message" => "Jenis senjata berhasil dibuat",
            "data" => $jenisSenjata
        ], 201);
    }

    /**
     * Menampilkan jenis senjata berdasarkan ID.
     */
    public function show(string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                "message" => "Jenis senjata tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 200,
            "message" => "Jenis senjata berhasil ditemukan",
            "data" => $jenisSenjata
        ]);
    }

    /**
     * Mengupdate jenis senjata berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                "message" => "Jenis senjata tidak ditemukan"
            ], 404);
        }

        $validatedData = $request->validate([
            "nama_jenis" => [
                "required",
                "max:100",
                Rule::unique('jenis_senjata', 'nama_jenis')->ignore($id, 'id_jenis')
            ],
            "deskripsi" => "nullable|string|max:255",
        ]);

        $jenisSenjata->update($validatedData);

        return response()->json([
            'status' => 200,
            "message" => "Jenis senjata berhasil diupdate",
            "data" => $jenisSenjata
        ]);
    }

    /**
     * Menghapus jenis senjata berdasarkan ID.
     */
    public function destroy(string $id)
    {
        $jenisSenjata = JenisSenjata::find($id);

        if (!$jenisSenjata) {
            return response()->json([
                'status' => 404,
                "message" => "Jenis senjata tidak ditemukan"
            ], 404);
        }

        $jenisSenjata->delete();

        return response()->json([
            'status' => 200,
            "message" => "Jenis senjata berhasil dihapus"
        ]);
    }
}
