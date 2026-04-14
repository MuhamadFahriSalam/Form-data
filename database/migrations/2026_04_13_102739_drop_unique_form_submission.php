<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 🔥 Drop foreign key dulu
        DB::statement('ALTER TABLE form_submissions DROP FOREIGN KEY form_submissions_form_id_foreign');
        DB::statement('ALTER TABLE form_submissions DROP FOREIGN KEY form_submissions_user_id_foreign');

        // 🔥 Drop unique index
        DB::statement('ALTER TABLE form_submissions DROP INDEX form_submissions_form_id_user_id_unique');

        // 🔥 Tambahkan kembali foreign key
        DB::statement('ALTER TABLE form_submissions ADD CONSTRAINT form_submissions_form_id_foreign FOREIGN KEY (form_id) REFERENCES forms(id) ON DELETE CASCADE');
        DB::statement('ALTER TABLE form_submissions ADD CONSTRAINT form_submissions_user_id_foreign FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE form_submissions ADD UNIQUE form_submissions_form_id_user_id_unique (form_id, user_id)');
    }
};
