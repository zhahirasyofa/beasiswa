<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan perubahan schema.
     */
    public function up(): void
    {
        Schema::table('zhahira_beasiswas', function (Blueprint $table) {
            $table->text('bantuan')->after('kategori_id');
        });
    }

    /**
     * Rollback schema ke kondisi semula.
     */
    public function down(): void
    {
        Schema::table('zhahira_beasiswas', function (Blueprint $table) {
            $table->dropColumn('bantuan');
        });
    }
};
