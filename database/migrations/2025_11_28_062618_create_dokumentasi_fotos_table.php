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
    Schema::create('dokumentasi_fotos', function (Blueprint $table) {
        $table->id();
        $table->foreignId('dokumentasi_id')->constrained('dokumentasi')->cascadeOnDelete();
        $table->string('file_name');
        $table->string('mime_type')->nullable();
        $table->timestamps();
    });
}




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dokumentasi_fotos');
    }
};
