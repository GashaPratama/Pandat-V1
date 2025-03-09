<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSenjata extends Model
{
    use HasFactory;

    protected $table = 'jenis_senjata'; // Pastikan nama tabel sesuai dengan database
    protected $primaryKey = 'id_jenis';
    public $timestamps = true;
    public $incrementing = true; // Jika ID adalah auto-increment
    protected $keyType = 'int'; // Jika ID adalah integer

    protected $fillable = [
        'nama_jenis',
        'deskripsi',
    ];

    // Relasi dengan Senjata
    public function senjatas()
    {
        return $this->hasMany(Senjata::class, 'id_jenis', 'id_jenis'); // Pastikan foreign key benar
    }
}
