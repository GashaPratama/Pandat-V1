<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PengirimanSenjata;

class PengirimanSenjataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/pengiriman",
     *     summary="Ambil semua pengiriman senjata",
     *     tags={"PengirimanSenjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function index()
    {
        return response()->json(PengirimanSenjata::all(), 200);
    }

    /**
     * @OA\Post(
     *     path="/pengiriman",
     *     summary="Tambah pengiriman baru",
     *     tags={"PengirimanSenjata"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_institusi","tanggal_pengiriman","tujuan","status_pengiriman"},
     *             @OA\Property(property="id_institusi", type="integer"),
     *             @OA\Property(property="tanggal_pengiriman", type="string", format="date-time"),
     *             @OA\Property(property="tujuan", type="string"),
     *             @OA\Property(property="status_pengiriman", type="string", enum={"diproses", "dikirim", "selesai"})
     *         )
     *     ),
     *     @OA\Response(response=201, description="Created")
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_institusi' => 'required|integer',
            'tanggal_pengiriman' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'status_pengiriman' => 'required|in:diproses,dikirim,selesai',
        ]);

        $pengiriman = PengirimanSenjata::create($data);
        return response()->json($pengiriman, 201);
    }

    /**
     * @OA\Get(
     *     path="/pengiriman/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Ambil detail pengiriman",
     *     tags={"PengirimanSenjata"},
     *     @OA\Parameter(
     *         name="id", in="path", required=true, @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="OK"),
     *     @OA\Response(response=404, description="Not found")
     * )
     */
    public function show($id)
    {
        $data = PengirimanSenjata::find($id);
        return $data ? response()->json($data, 200) : response()->json(['message' => 'Tidak ditemukan'], 404);
    }

    /**
     * @OA\Put(
     *     path="/pengiriman/{id}",
     *     security={{"sanctum":{}}},
     *     summary="Perbarui pengiriman",
     *     tags={"PengirimanSenjata"},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="id_institusi", type="integer"),
     *             @OA\Property(property="tanggal_pengiriman", type="string", format="date-time"),
     *             @OA\Property(property="tujuan", type="string"),
     *             @OA\Property(property="status_pengiriman", type="string", enum={"diproses", "dikirim", "selesai"})
     *         )
     *     ),
     *     @OA\Response(response=200, description="Updated")
     * )
     */
    public function update(Request $request, $id)
    {
        $pengiriman = PengirimanSenjata::find($id);
        if (!$pengiriman) {
            return response()->json(['message' => 'Tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'id_institusi' => 'required|integer',
            'tanggal_pengiriman' => 'required|date',
            'tujuan' => 'required|string|max:255',
            'status_pengiriman' => 'required|in:diproses,dikirim,selesai',
        ]);

        $pengiriman->update($data);
        return response()->json($pengiriman, 200);
    }

    /**
     * @OA\Delete(
     *     path="/pengiriman/{id}",
     *     summary="Hapus pengiriman",
     *     tags={"PengirimanSenjata"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=204, description="Deleted")
     * )
     */
    public function destroy($id)
    {
        $pengiriman = PengirimanSenjata::find($id);
        if (!$pengiriman) {
            return response()->json(['message' => 'Tidak ditemukan'], 404);
        }

        $pengiriman->delete();
        return response()->json(null, 204);
    }
}
