<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Senjata extends Model
{
    use HasFactory;

    protected $table = 'senjata';
    protected $primaryKey = 'id_senjata';
    public $timestamps = true;

    protected $fillable = [
        'nama_senjata',
        'id_jenis',
        'id_gudang',
        'stok',
        'kaliber',
        'nomor_seri',
    ];

    public function gudang()
    {
        return $this->belongsTo(Gudang::class, 'id_gudang');
    }

    public function jenis()
    {
        return $this->belongsTo(JenisSenjata::class, 'id_jenis');
    }
}
