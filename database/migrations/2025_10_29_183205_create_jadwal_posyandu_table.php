<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwal_posyandu', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->unsignedBigInteger('posyandu_id');
            $table->date('tanggal');
            $table->string('tema');
            $table->text('keterangan')->nullable();
            $table->string('poster')->nullable(); // untuk media poster kegiatan
            $table->timestamps();

            $table->foreign('posyandu_id')->references('id')->on('posyandu')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_posyandu');
    }
};
