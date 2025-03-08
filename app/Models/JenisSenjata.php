<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSenjata extends Model
{
    use HasFactory;

    protected $table = 'jenis_senjatas';
    protected $primaryKey = 'id_jenis';
    public $timestamps = true;

    protected $fillable = [
        'nama_jenis',
        'deskripsi',
    ];


    public function senjata()
{
    return $this->hasMany(Senjata::class, 'id_jenis');
}
}
