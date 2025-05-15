<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\DetailPengiriman;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="DetailPengiriman",
 *     type="object",
 *     required={"id_pengiriman", "id_senjata", "jumlah", "created_at"},
 *     @OA\Property(property="id_detail_pengiriman", type="integer", example=1),
 *     @OA\Property(property="id_pengiriman", type="integer", example=1001),
 *     @OA\Property(property="id_senjata", type="integer", example=2002),
 *     @OA\Property(property="jumlah", type="integer", example=10),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-15T10:00:00Z")
 * )
 */

class DetailPengirimanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/detail-pengiriman",
     *     tags={"DetailPengiriman"},
     *     summary="Menampilkan semua detail pengiriman",
     *     @OA\Response(
     *         response=200,
     *         description="Data ditemukan",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/DetailPengiriman"))
     *     )
     * )
     */
    public function index()
    {
        return response()->json(DetailPengiriman::all());
    }

    /**
     * @OA\Post(
     *     path="/api/detail-pengiriman",
     *     tags={"DetailPengiriman"},
     *     summary="Menambahkan data detail pengiriman",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"id_pengiriman","id_senjata","jumlah","created_at"},
     *             @OA\Property(property="id_pengiriman", type="integer"),
     *             @OA\Property(property="id_senjata", type="integer"),
     *             @OA\Property(property="jumlah", type="integer"),
     *             @OA\Property(property="created_at", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Data berhasil disimpan",
     *         @OA\JsonContent(ref="#/components/schemas/DetailPengiriman")
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_pengiriman' => 'required|integer',
            'id_senjata' => 'required|integer',
            'jumlah' => 'required|integer',
            'created_at' => 'required|date'
        ]);

        $detail = DetailPengiriman::create($data);

        return response()->json($detail, 201);
    }
}

