<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LisensiSenjata extends Model
{
    use HasFactory;

    protected $table = 'lisensi_senjata';
    protected $primaryKey = 'id_lisensi';

    protected $fillable = [
        'id_senjata',
        'nomor_lisensi',
        'tanggal_berlaku',
        'tanggal_kadaluarsa',
        'status',
    ];

    protected $casts = [
        'tanggal_berlaku' => 'datetime',
        'tanggal_kadaluarsa' => 'datetime',
    ];

    /**
     * Contoh relasi ke model Senjata (jika ada)
     */
    public function senjata()
    {
        return $this->belongsTo(Senjata::class, 'id_senjata');
    }
}
