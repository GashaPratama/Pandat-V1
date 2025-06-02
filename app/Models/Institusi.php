<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institusi extends Model
{
    use HasFactory;

    protected $table = 'institusi';
    protected $primaryKey = 'id_institusi';
    public $timestamps = true;

    protected $fillable = [
        'nama_institusi',
        'alamat',
        'kontak',
    ];

    // public function institusi()
    // {
    //     return $this->belongsTo(Institusi::class, 'id_institusi', 'id_institusi');
    // }
}

