<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diary_entries', function (Blueprint $table) {
            // Menambahkan kolom ai_suggestion tepat setelah kolom cloud_type
            $table->text('ai_suggestion')->nullable()->after('cloud_type');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down()

    {
        Schema::table('diary_entries', function (Blueprint $table) {
            $table->dropColumn('ai_suggestion');
        });
    }
};
