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
        $validated = $request->validate([
            'id_gudang' => 'required|exists:gudangs,id_gudang',
            'nama_karyawan' => 'required|string|max:100',
            'posisi' => 'required|string|max:50',
            'kontak' => 'required|string|max:100',
            'tanggal_mulai' => 'required|date',
        ]);

        $karyawan = KaryawanGudang::create([
            ...$validated,
            'created_at' => now()
        ]);

        return response()->json($karyawan, 201);
    }

    /**
     * @OA\Get(
     *     path="/karyawan-gudang/{id}",
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
        $karyawan = KaryawanGudang::findOrFail($id);

        $validated = $request->validate([
            'nama_karyawan' => 'string|max:100',
            'posisi' => 'string|max:50',
            'kontak' => 'string|max:100',
            'tanggal_mulai' => 'date',
        ]);

        $karyawan->update($validated);
        return response()->json($karyawan);
    }

    /**
     * @OA\Delete(
     *     path="/karyawan-gudang/{id}",
     *     tags={"KaryawanGudang"},
     *     summary="Hapus karyawan gudang",
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
        $karyawan = KaryawanGudang::findOrFail($id);
        $karyawan->delete();
        return response()->json(null, 204);
    }
}
