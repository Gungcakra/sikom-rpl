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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_bank');
            $table->integer('nominal');
            $table->enum('jenis_transaksi', ['pemasukan', 'pengeluaran']);
            $table->string('keterangan')->nullable();
            $table->timestamps();

            $table->foreign('id_bank')->references('id_bank')->on('banks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
