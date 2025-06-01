<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\LisensiSenjata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        try {
            $lisensi = LisensiSenjata::with('senjata')->get();
            return response()->json([
                'message' => 'Data lisensi berhasil diambil',
                'data' => $lisensi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $validator = Validator::make($request->all(), [
                'id_senjata' => 'required|exists:senjatas,id',
                'nomor_lisensi' => 'required|string|unique:lisensi_senjatas,nomor_lisensi',
                'tanggal_berlaku' => 'required|date',
                'tanggal_kadaluarsa' => 'required|date|after:tanggal_berlaku',
                'status' => 'required|in:aktif,kadaluarsa,diperbarui'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $lisensi = LisensiSenjata::create($request->all());

            return response()->json([
                'message' => 'Lisensi berhasil ditambahkan',
                'data' => $lisensi
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menambahkan lisensi',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $lisensi = LisensiSenjata::with('senjata')->findOrFail($id);
            return response()->json([
                'message' => 'Detail lisensi berhasil diambil',
                'data' => $lisensi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Lisensi tidak ditemukan',
                'error' => $e->getMessage()
            ], 404);
        }
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
        try {
            $lisensi = LisensiSenjata::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'id_senjata' => 'sometimes|exists:senjatas,id',
                'nomor_lisensi' => 'sometimes|string|unique:lisensi_senjatas,nomor_lisensi,' . $id,
                'tanggal_berlaku' => 'sometimes|date',
                'tanggal_kadaluarsa' => 'sometimes|date|after:tanggal_berlaku',
                'status' => 'sometimes|in:aktif,kadaluarsa,diperbarui'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            $lisensi->update($request->all());

            return response()->json([
                'message' => 'Lisensi berhasil diperbarui',
                'data' => $lisensi
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui lisensi',
                'error' => $e->getMessage()
            ], 500);
        }
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
        try {
            $lisensi = LisensiSenjata::findOrFail($id);
            $lisensi->delete();

            return response()->json([
                'message' => 'Lisensi berhasil dihapus'
            ], 204);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus lisensi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
