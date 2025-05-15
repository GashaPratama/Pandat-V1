<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DetailPengiriman extends Model
{
    use HasFactory;

    protected $table = 'detail_pengiriman';

    protected $fillable = [
        'id_pengiriman',
        'id_senjata',
        'jumlah',
        'created_at',
    ];

    public $timestamps = false;

    /**
     * Relasi ke model PengirimanSenjata
     */
    public function pengiriman()
    {
        return $this->belongsTo(PengirimanSenjata::class, 'id_pengiriman', 'id_pengiriman');
    }

    /**
     * Relasi ke model Senjata
     */
    public function senjata()
    {
        return $this->belongsTo(Senjata::class, 'id_senjata', 'id_senjata');
    }
}
