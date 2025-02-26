<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gudang;

class GudangSeeder extends Seeder
{
    public function run()
    {
        Gudang::create([
            'nama_gudang' => 'Gudang Utama',
            'alamat' => 'Jl. Raya No. 1',
            'kota' => 'Jakarta'
        ]);
    }
}

