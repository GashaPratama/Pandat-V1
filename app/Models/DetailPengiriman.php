<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPengiriman extends Model
{
    protected $table = 'detail_pengiriman';

    protected $fillable = [
        'id_pengiriman',
        'id_senjata',
        'jumlah',
        'created_at'
    ];

    public $timestamps = false;
}
