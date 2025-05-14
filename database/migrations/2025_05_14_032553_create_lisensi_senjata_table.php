<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('lisensi_senjata', function (Blueprint $table) {
            $table->id('id_lisensi');
            $table->unsignedBigInteger('id_senjata');
            $table->string('nomor_lisensi', 100);
            $table->dateTime('tanggal_berlaku');
            $table->dateTime('tanggal_kadaluarsa');
            $table->enum('status', ['aktif', 'kadaluarsa', 'diperbarui']);
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lisensi_senjata');
    }
};
