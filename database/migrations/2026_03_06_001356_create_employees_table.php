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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('npk', 6)->unique();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('departemen')->nullable();
            $table->enum('status_emp', ['Aktif', 'Non-Aktif'])->default('Aktif');
            $table->enum('status', ['Tetap', 'Kontrak', 'Magang'])->default('Kontrak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
