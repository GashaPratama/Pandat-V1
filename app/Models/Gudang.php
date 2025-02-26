<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gudang extends Model
{
    use HasFactory;

    protected $table = 'gudang';
    protected $primaryKey = 'id_gudang';
    public $timestamps = true;

    protected $fillable = [
        'nama_gudang',
        'alamat',
        'kota',
    ];

    public function senjata()
{
    return $this->hasMany(Senjata::class, 'id_gudang');
}

}
