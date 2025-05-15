<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('detail_pengiriman', function (Blueprint $table) {
            $table->id('id_detail_pengiriman');
            $table->unsignedBigInteger('id_pengiriman');
            $table->unsignedBigInteger('id_senjata');
            $table->integer('jumlah');
            $table->dateTime('created_at');

            // Foreign keys (optional)
            $table->foreign('id_pengiriman')->references('id_pengiriman')->on('pengiriman_senjata')->onDelete('cascade');
            $table->foreign('id_senjata')->references('id_senjata')->on('senjatas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_pengiriman');
    }
};
