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
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id('id_kegiatan');
            $table->unsignedBigInteger('id_organisasi');
            $table->string('nama_kegiatan');
            $table->text('deskripsi');
            $table->date('tanggal_pelaksanaan');
            $table->integer('kuota_peserta');
            $table->string('lokasi');
            $table->string('status');
            $table->timestamps();

            $table->foreign('id_organisasi')->references('id_organisasi')->on('organisasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatans');
    }
};
