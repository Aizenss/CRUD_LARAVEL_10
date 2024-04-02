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
            $table->id();
            $table->date('tanggal');
            $table->integer('stok');
            // $table->unsignedBigInteger('id_supplier');
            
            $table->foreignId('id_pengurus')->constrained('penguruses');
            // $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreignId('id_supplier')->constrained('suplliers');
            $table->foreignId('id_produk')->constrained('produks');
            $table->timestamps();
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
