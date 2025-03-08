<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudangs'; // ✅ Sesuai dengan migration
    protected $primaryKey = 'id_gudang'; // ✅ Sesuai dengan migration
    public $timestamps = true;

    protected $fillable = [
        'nama_gudang',
        'alamat',
        'kota',
    ];

    // ✅ Pastikan relasi benar
    public function senjatas() // Ubah nama relasi agar lebih jelas
    {
        return $this->hasMany(Senjata::class, 'id_gudang', 'id_gudang'); // Pastikan foreign key sesuai
    }
}
