<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pengiriman_senjata', function (Blueprint $table) {
            $table->id('id_pengiriman');
            $table->unsignedBigInteger('id_institusi');
            $table->dateTime('tanggal_pengiriman');
            $table->string('tujuan', 255);
            $table->enum('status_pengiriman', ['diproses', 'dikirim', 'selesai']);
            $table->timestamps(); // created_at & updated_at

            // Foreign key (optional)
            // $table->foreign('id_institusi')->references('id')->on('institusi')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengiriman_senjata');
    }
};
