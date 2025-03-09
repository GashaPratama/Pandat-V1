<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Senjata extends Model
{
    use HasFactory;

    protected $table = 'senjatas'; // Pastikan nama tabel sesuai dengan database
    protected $primaryKey = 'id_senjata';
    public $timestamps = true;
    public $incrementing = true; // Jika ID adalah auto-increment
    protected $keyType = 'int'; // Jika ID adalah integer

    protected $fillable = [
        'nama_senjata',
        'id_jenis',
        'id_gudang',
        'stok',
        'kaliber',
        'nomor_seri',
    ];

    // Relasi dengan Gudang
    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id_gudang'); // Pastikan foreign key benar
    }

    // Relasi dengan JenisSenjata
    public function jenis()
    {
        return $this->belongsTo(JenisSenjata::class, 'id_jenis', 'id_jenis'); // Pastikan foreign key benar
    }
}
