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
        Schema::create('pengumumen', function (Blueprint $table) {
           
                $table->id('id_pengumuman');
                $table->unsignedBigInteger('id_organisasi');
                $table->string('judul');
                $table->text('isi');
                $table->date('tanggal_post');
                $table->timestamps();

                $table->foreign('id_organisasi')->references('id_organisasi')->on('organisasis')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumumen');
    }
};
