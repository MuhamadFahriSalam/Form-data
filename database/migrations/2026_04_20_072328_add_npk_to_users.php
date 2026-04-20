<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Kalau kolom belum ada → buat
        if (!Schema::hasColumn('users', 'npk')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('npk')->after('id');
            });
        }

        // Tambahkan UNIQUE jika belum ada
        try {
            Schema::table('users', function (Blueprint $table) {
                $table->unique('npk');
            });
        } catch (\Exception $e) {
            // ignore kalau sudah unique
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // drop unique dulu (kalau ada)
            try {
                $table->dropUnique(['npk']);
            } catch (\Exception $e) {}

            // drop kolom kalau ada
            if (Schema::hasColumn('users', 'npk')) {
                $table->dropColumn('npk');
            }
        });
    }
};