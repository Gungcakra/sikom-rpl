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
        Schema::create('penguruses', function (Blueprint $table) {
            $table->id('id_pengurus');
            $table->unsignedBigInteger('id_anggota');
            $table->string('jabatan');
            $table->date('periode_mulai');
            $table->date('periode_akhir');
            $table->timestamps();

            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penguruses');
    }
};
