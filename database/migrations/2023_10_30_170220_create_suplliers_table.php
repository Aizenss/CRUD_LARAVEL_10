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
        Schema::create('suplliers', function (Blueprint $table) {
            $table->id();
            $table->string('nama_s');
            $table->string('no_hp_sup');
            $table->string('alamat_s');
            $table->string('email_s');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suplliers');
    }
};
