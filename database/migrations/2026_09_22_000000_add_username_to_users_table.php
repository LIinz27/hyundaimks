<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('name');
        });

        // Isi username untuk user yang ada (idempoten).
        DB::table('users')->where('id', 2)->whereNull('username')
            ->update(['username' => 'admin']);
        DB::table('users')->where('id', 26)->whereNull('username')
            ->update(['username' => 'rukman.fadli']);

        // Hapus user asing hasil factory (id=27, wdickens@example.net,
        // password default factory). Idempoten: delete by email.
        DB::table('users')->where('email', 'wdickens@example.net')->delete();
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['username']);
            $table->dropColumn('username');
        });
    }
};
