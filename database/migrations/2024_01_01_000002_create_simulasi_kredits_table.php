<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('simulasi_kredits', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('telepon');
            $table->string('kota');
            $table->string('tipe_mobil');
            $table->unsignedTinyInteger('tenor');
            $table->unsignedBigInteger('uang_muka');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('simulasi_kredits');
    }
};
