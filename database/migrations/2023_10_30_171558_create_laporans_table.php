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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_l');
            $table->foreignId('id_pengurus')->constrained('penguruses');
            $table->foreignId('id_produk')->constrained('produks');
            $table->foreignId('id_supplier')->constrained('suplliers');
            $table->string('laporan');
            // $table->unsignedBigInteger('id_transaksi');
            // $table->unsignedBigInteger('id_produk');
            // $table->unsignedBigInteger('id_pengurus');
            // $table->unsignedBigInteger('id_supplier');
            // $table->string('laporan');
            
            // // $table -> foreign('id_transaksi')->references('id')->on('transaksis');
            // $table -> foreign('id_produk')->references('id')->on('produks');
            // $table -> foreign('id_pengurus')->references('id')->on('penguruses');
            // $table -> foreign('id_supplier')->references('id')->on('suplliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
