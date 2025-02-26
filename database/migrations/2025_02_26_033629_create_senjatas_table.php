<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('senjatas', function (Blueprint $table) {
            $table->id('id_senjata');
            $table->string('nama_senjata', 100);
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_gudang');
            $table->integer('stok');
            $table->string('kaliber', 50);
            $table->string('nomor_seri', 100);
            $table->timestamps();

            $table->foreign('id_gudang')->references('id_gudang')->on('gudangs')->onDelete('cascade');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis_senjata')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senjatas');
    }
};
