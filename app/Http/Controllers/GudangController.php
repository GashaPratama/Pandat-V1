<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gudang;
use App\Http\Controllers\Controller;

class GudangController extends Controller
{
    /**
     * Menampilkan semua gudang.
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
     * Menyimpan gudang baru.
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
     * Menampilkan gudang berdasarkan ID.
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
     * Mengupdate gudang berdasarkan ID.
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
     * Menghapus gudang berdasarkan ID.
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
