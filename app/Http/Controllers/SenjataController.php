<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Senjata;
use App\Models\JenisSenjata;
use App\Models\Gudang;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class SenjataController extends Controller
{
    /**
     * Menampilkan semua senjata.
     */
    public function index()
    {
        $senjatas = Senjata::with(['jenis', 'gudang'])->get(); // Mengambil data dengan relasi
        return response()->json([
            'status' => 200,
            'message' => "Data senjata ditemukan",
            'data' => $senjatas
        ]);
    }

    /**
     * Menyimpan senjata baru.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                "nama_senjata" => "required|string|max:100",
                "id_jenis" => "required|exists:jenis_senjata,id_jenis",
                "id_gudang" => "required|exists:gudangs,id_gudang",
                "stok" => "required|integer|min:0",
                "kaliber" => "required|string|max:50",
                "nomor_seri" => "required|string|max:100|unique:senjatas,nomor_seri",
            ]);
    
            $senjata = Senjata::create($validatedData);
    
            return response()->json([
                'status' => 201,
                "message" => "Senjata berhasil dibuat",
                "data" => $senjata
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                "message" => "Terjadi kesalahan saat menyimpan data",
                "error" => $e->getMessage() // Menampilkan pesan error
            ], 500);
        }
    }

    /**
     * Menampilkan senjata berdasarkan ID.
     */
    public function show(string $id)
    {
        $senjata = Senjata::with(['jenis', 'gudang'])->find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil ditemukan",
            "data" => $senjata
        ]);
    }

    /**
     * Mengupdate senjata berdasarkan ID.
     */
    public function update(Request $request, string $id)
    {
        $senjata = Senjata::find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        $validatedData = $request->validate([
            "nama_senjata" => "required|string|max:100",
            "id_jenis" => "required|exists:jenis_senjatas,id_jenis",
            "id_gudang" => "required|exists:gudangs,id_gudang",
            "stok" => "required|integer|min:0",
            "kaliber" => "required|string|max:50",
            "nomor_seri" => [
                "required",
                "string",
                "max:100",
                Rule::unique('senjatas', 'nomor_seri')->ignore($id, 'id_senjata')
            ],
        ]);

        $senjata->update($validatedData);

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil diupdate",
            "data" => $senjata
        ]);
    }

    /**
     * Menghapus senjata berdasarkan ID.
     */
    public function destroy(string $id)
    {
        $senjata = Senjata::find($id);

        if (!$senjata) {
            return response()->json([
                'status' => 404,
                "message" => "Senjata tidak ditemukan"
            ], 404);
        }

        $senjata->delete();

        return response()->json([
            'status' => 200,
            "message" => "Senjata berhasil dihapus"
        ]);
    }
}
