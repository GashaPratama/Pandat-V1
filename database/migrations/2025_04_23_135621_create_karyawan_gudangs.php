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
        Schema::create('karyawan_gudang', function (Blueprint $table) {
            $table->id('id_karyawan');
            $table->unsignedBigInteger('id_gudang');
            $table->string('nama_karyawan', 100);
            $table->string('posisi', 50);
            $table->string('kontak', 100);
            $table->dateTime('tanggal_mulai');
            $table->timestamp('created_at')->useCurrent();

            // Foreign key constraint
            $table->foreign('id_gudang')->references('id_gudang')->on('gudangs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_gudang');
    }
};
