<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('perawatan_senjata', function (Blueprint $table) {
            $table->id('id_perawatan');
            $table->unsignedBigInteger('id_senjata');
            $table->dateTime('tanggal_perawatan');
            $table->string('jenis_perawatan', 100);
            $table->string('teknisi', 100);
            $table->timestamps(); // created_at & updated_at

            // Foreign key (optional, jika tabel `senjata` ada)
            // $table->foreign('id_senjata')->references('id')->on('senjata')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('perawatan_senjata');
    }
};
