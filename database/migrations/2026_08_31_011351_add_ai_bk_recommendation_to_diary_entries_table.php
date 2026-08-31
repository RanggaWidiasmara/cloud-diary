<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            // Nambahin kolom baru setelah ai_suggestion biar rapi
            $table->text('ai_bk_recommendation')->nullable()->after('ai_suggestion');
        });
    }

    public function down(): void
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            // Rollback kalau ternyata mau dihapus
            $table->dropColumn('ai_bk_recommendation');
        });
    }
};
