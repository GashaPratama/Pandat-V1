<?php
namespace App\Http\Controllers\Api;

use App\Models\KaryawanGudang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use OpenApi\Annotations as OA;

class KaryawanGudangController extends Controller
{
    /**
     * @OA\Get(
     *     path="/karyawan-gudang",
     *     tags={"KaryawanGudang"},
     *     summary="Ambil semua data karyawan gudang",
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="Berhasil mengambil data")
     * )
     */
    public function index()
    {
        return KaryawanGudang::with('gudang')->get();
    }

    /**
     * @OA\Post(
     *     path="/karyawan-gudang",
     *     tags={"KaryawanGudang"},
     *     summary="Simpan data karyawan baru",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_gudang", "nama_karyawan", "posisi", "kontak", "tanggal_mulai"},
     *             @OA\Property(property="id_gudang", type="integer"),
     *             @OA\Property(property="nama_karyawan", type="string"),
     *             @OA\Property(property="posisi", type="string"),
     *             @OA\Property(property="kontak", type="string"),
     *             @OA\Property(property="tanggal_mulai", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Berhasil disimpan")
     * )
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id_gudang' => 'required|exists:gudangs,id_gudang',
                'nama_karyawan' => 'required|string|max:100',
                'posisi' => 'required|string|max:50',
                'kontak' => 'required|string|max:100',
                'tanggal_mulai' => 'required|date',
            ]);

            // Konversi tanggal ke format yang sesuai
            $validated['tanggal_mulai'] = date('Y-m-d H:i:s', strtotime($validated['tanggal_mulai']));

            $karyawan = KaryawanGudang::create($validated);

            return response()->json([
                'message' => 'Data karyawan berhasil disimpan',
                'data' => $karyawan
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/karyawan-gudang/{id}",
     *     security={{"sanctum":{}}},
     *     tags={"KaryawanGudang"},
     *     summary="Ambil detail karyawan gudang",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detail ditemukan"),
     *     @OA\Response(response=404, description="Tidak ditemukan")
     * )
     */
    public function show($id)
    {
        $karyawan = KaryawanGudang::with('gudang')->findOrFail($id);
        return response()->json($karyawan);
    }

    /**
     * @OA\Put(
     *     path="/karyawan-gudang/{id}",
     *     tags={"KaryawanGudang"},
     *     summary="Update data karyawan gudang",
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
     *             @OA\Property(property="nama_karyawan", type="string"),
     *             @OA\Property(property="posisi", type="string"),
     *             @OA\Property(property="kontak", type="string"),
     *             @OA\Property(property="tanggal_mulai", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Berhasil diupdate"),
     *     @OA\Response(response=404, description="Tidak ditemukan")
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $karyawan = KaryawanGudang::findOrFail($id);

            $validated = $request->validate([
                'id_gudang' => 'sometimes|exists:gudangs,id_gudang',
                'nama_karyawan' => 'sometimes|string|max:100',
                'posisi' => 'sometimes|string|max:50',
                'kontak' => 'sometimes|string|max:100',
                'tanggal_mulai' => 'sometimes|date',
            ]);

            $karyawan->update($validated);

            return response()->json([
                'message' => 'Data karyawan berhasil diperbarui',
                'data' => $karyawan
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/karyawan-gudang/{id}",
     *     tags={"KaryawanGudang"},
     *     summary="Hapus karyawan gudang",
     *     security={{"sanctum":{}}},
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
        try {
            $karyawan = KaryawanGudang::findOrFail($id);
            $karyawan->delete();

            return response()->json([
                'message' => 'Data karyawan berhasil dihapus'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
