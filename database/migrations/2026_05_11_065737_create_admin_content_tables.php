<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Daftar mobil & harga (tampil di homepage kartu produk)
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('harga');
            $table->string('gambar');        // basename, e.g. Hyundai-Stargazer.png
            $table->string('kategori');      // mpv | suv | eco
            $table->string('url');           // /product/stargazer
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });

        // Banner / gambar sampul homepage
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('filename');      // path relatif dari public, e.g. images/SAMPUL-WEB-1.png
            $table->string('judul')->nullable();
            $table->boolean('aktif')->default(false);
            $table->timestamps();
        });

        // Profil sales consultant
        Schema::create('sales_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jabatan')->default('Profesional Sales Consultant');
            $table->string('foto');          // basename di /images/
            $table->string('telepon');
            $table->string('whatsapp');
            $table->json('keunggulan')->nullable();
            $table->timestamps();
        });

        // Pengaturan kontak global (key-value)
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Partner finance & leasing
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('filename');      // basename di /images/finance/
            $table->unsignedSmallInteger('urutan')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('sales_profiles');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('partners');
    }
};
