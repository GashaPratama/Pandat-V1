<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanSenjata extends Model
{
    use HasFactory;

    protected $table = 'perawatan_senjata';
    protected $primaryKey = 'id_perawatan';

    protected $fillable = [
        'id_senjata',
        'tanggal_perawatan',
        'jenis_perawatan',
        'teknisi',
    ];

    protected $casts = [
        'tanggal_perawatan' => 'datetime',
    ];

    /**
     * Relasi ke model Senjata (jika ada)
     */
    public function senjata()
    {
        return $this->belongsTo(Senjata::class, 'id_senjata');
    }
}
