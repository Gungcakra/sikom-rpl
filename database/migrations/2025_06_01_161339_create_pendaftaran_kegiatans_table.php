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
        Schema::create('pendaftaran_kegiatans', function (Blueprint $table) {
            
                $table->id('id_pendaftaran');
                $table->unsignedBigInteger('id_kegiatan');
                $table->unsignedBigInteger('id_anggota');
                $table->date('tanggal_daftar');
                $table->string('status');
                $table->timestamps();

                $table->foreign('id_kegiatan')->references('id_kegiatan')->on('kegiatans')->onDelete('cascade');
                $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_kegiatans');
    }
};
