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
  Schema::create('layanan_posyandu', function (Blueprint $table) {
    $table->id('layanan_id');

    $table->unsignedBigInteger('jadwal_id');
    $table->unsignedBigInteger('warga_id');

    $table->float('berat')->nullable();
    $table->float('tinggi')->nullable();
    $table->string('vitamin')->nullable();
    $table->text('konseling')->nullable();

    $table->timestamps();

    // FIX FOREIGN KEY
    $table->foreign('jadwal_id')->references('jadwal_id')->on('jadwal_posyandu')->onDelete('cascade');
    $table->foreign('warga_id')->references('id')->on('warga')->onDelete('cascade');
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_posyandu');
    }
};
