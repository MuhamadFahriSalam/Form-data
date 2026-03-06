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
        Schema::create('employee_fields', function (Blueprint $table) {
            $table->id();

            $table->string('key')->unique(); // contoh: bpjs_kesehatan
            $table->string('label');         // contoh: Nomor BPJS Kesehatan
            $table->string('type');          // text, textarea, number, date, select, radio, checkbox, file
            $table->boolean('required')->default(false);
            $table->json('options')->nullable(); // untuk select/radio/checkbox
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_fields');
    }
};
