<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengirimanSenjata extends Model
{
    use HasFactory;

    protected $table = 'pengiriman_senjata';
    protected $primaryKey = 'id_pengiriman';

    protected $fillable = [
        'id_institusi',
        'tanggal_pengiriman',
        'tujuan',
        'status_pengiriman',
    ];

    protected $casts = [
        'tanggal_pengiriman' => 'datetime',
    ];

    // Jika ada model Institusi
    public function institusi()
    {
        return $this->belongsTo(Institusi::class, 'id_institusi');
    }
}
