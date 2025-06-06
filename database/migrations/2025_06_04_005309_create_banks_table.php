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
        Schema::create('banks', function (Blueprint $table) {
            $table->id('id_bank');
            $table->unsignedBigInteger('id_organisasi');
            $table->string('nama_bank');
            $table->string('nomor_rekening')->unique();
            $table->string('atas_nama');
            $table->integer('nominal')->default(0);
            $table->timestamps();
            $table->foreign('id_organisasi')->references('id_organisasi')->on('organisasis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
