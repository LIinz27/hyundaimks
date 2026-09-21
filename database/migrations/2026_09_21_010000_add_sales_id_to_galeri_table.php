<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Galeri berubah dari milik dealer bersama menjadi milik tiap sales.
 *
 * Tujuh baris galeri yang sudah ada (foto Hyundai) adalah milik Rukman Fadli,
 * satu-satunya sales aktif. Kolom sales_id dibuat nullable lebih dulu supaya
 * baris lama tidak melanggar foreign key, lalu diisi, baru dijadikan wajib.
 * Urutan ini penting: kalau langsung ->constrained() sementara baris lama
 * belum punya sales_id, migration gagal di SQLite.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('sales_id')->nullable()->after('id');
        });

        // Pindahkan galeri lama ke sales yang cocok, kalau sales-nya ada.
        $salesId = DB::table('sales')->where('slug', 'rukman-fadli')->value('id');

        if ($salesId) {
            DB::table('galeri')->whereNull('sales_id')->update(['sales_id' => $salesId]);
        }

        Schema::table('galeri', function (Blueprint $table) {
            $table->foreignId('sales_id')->nullable(false)->change();
            $table->foreign('sales_id')->references('id')->on('sales')->cascadeOnDelete();
            $table->index('sales_id');
        });
    }

    public function down(): void
    {
        Schema::table('galeri', function (Blueprint $table) {
            $table->dropForeign(['sales_id']);
            $table->dropIndex(['sales_id']);
            $table->dropColumn('sales_id');
        });
    }
};
