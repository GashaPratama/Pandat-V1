<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class LisensiSenjataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/lisensi",
     *     summary="Ambil semua lisensi senjata",
     *     tags={"LisensiSenjata"},
     *     @OA\Response(
     *         response=200,
     *         description="Sukses mengambil data lisensi"
     *     )
     * )
     */
    public function index()
    {
        // logika mengambil semua lisensi
    }

    /**
     * @OA\Post(
     *     path="/lisensi",
     *     summary="Tambah lisensi baru",
     *     tags={"LisensiSenjata"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_senjata","nomor_lisensi","tanggal_berlaku","tanggal_kadaluarsa","status"},
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="nomor_lisensi", type="string"),
     *             @OA\Property(property="tanggal_berlaku", type="string", format="date-time"),
     *             @OA\Property(property="tanggal_kadaluarsa", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", enum={"aktif","kadaluarsa","diperbarui"})
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lisensi berhasil ditambahkan"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // logika menyimpan lisensi
    }

    /**
     * @OA\Get(
     *     path="/lisensi/{id}",
     *     summary="Ambil detail lisensi",
     *     tags={"LisensiSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Detail lisensi ditemukan"),
     *     @OA\Response(response=404, description="Lisensi tidak ditemukan")
     * )
     */
    public function show($id)
    {
        // logika menampilkan lisensi berdasarkan ID
    }

    /**
     * @OA\Put(
     *     path="/lisensi/{id}",
     *     summary="Perbarui lisensi",
     *     tags={"LisensiSenjata"},
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
     *             @OA\Property(property="nomor_lisensi", type="string"),
     *             @OA\Property(property="tanggal_berlaku", type="string", format="date-time"),
     *             @OA\Property(property="tanggal_kadaluarsa", type="string", format="date-time"),
     *             @OA\Property(property="status", type="string", enum={"aktif","kadaluarsa","diperbarui"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Lisensi diperbarui")
     * )
     */
    public function update(Request $request, $id)
    {
        // logika update lisensi
    }

    /**
     * @OA\Delete(
     *     path="/lisensi/{id}",
     *     summary="Hapus lisensi",
     *     tags={"LisensiSenjata"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=204, description="Lisensi dihapus")
     * )
     */
    public function destroy($id)
    {
        // logika hapus lisensi
    }
}
