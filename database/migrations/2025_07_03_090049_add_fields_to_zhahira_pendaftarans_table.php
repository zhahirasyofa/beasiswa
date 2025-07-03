<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('zhahira_pendaftarans', function (Blueprint $table) {
            $table->string('nim')->after('beasiswa_id');
            $table->string('prodi')->after('nim');
            $table->string('asal_kampus')->after('prodi');
            $table->string('semester')->after('asal_kampus');
            $table->string('no_telepon')->after('semester');
        });
    }

    public function down(): void
    {
        Schema::table('zhahira_pendaftarans', function (Blueprint $table) {
            $table->dropColumn(['nim', 'prodi', 'asal_kampus', 'semester', 'no_telepon']);
        });
    }
};
