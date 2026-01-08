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
    Schema::create('catatan_imunisasi', function (Blueprint $table) {
        $table->id('imunisasi_id');
        $table->unsignedBigInteger('warga_id');
        $table->string('jenis_vaksin');
        $table->date('tanggal');
        $table->string('lokasi');
        $table->string('nakes');
        $table->string('media')->nullable(); // file scan
        $table->timestamps();

        $table->foreign('warga_id')->references('id')->on('warga')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catatan_imunisasi');
    }
};
