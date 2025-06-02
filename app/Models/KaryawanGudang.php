<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KaryawanGudang extends Model
{
    protected $table = 'karyawan_gudang';
    protected $primaryKey = 'id_karyawan';
    public $timestamps = false; 

    protected $fillable = [
        'id_gudang',
        'nama_karyawan',
        'posisi',
        'kontak',
        'tanggal_mulai',
        'created_at',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'created_at' => 'datetime'
    ];

    /**
     * Relasi ke Gudang
     */
    public function gudang(): BelongsTo
    {
        return $this->belongsTo(Gudang::class, 'id_gudang', 'id_gudang');
    }
}
