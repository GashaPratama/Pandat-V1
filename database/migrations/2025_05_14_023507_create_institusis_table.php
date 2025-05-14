<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     public function up()
    {
        Schema::create('institusi', function (Blueprint $table) {
            $table->id('id_institusi');
            $table->string('nama_institusi', 100);
            $table->string('alamat', 255);
            $table->string('kontak', 100);
            $table->timestamps(); // otomatis membuat created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('institusi');
    }
};
