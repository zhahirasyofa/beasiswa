<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('zhahira_pengumumans', function (Blueprint $table) {
            $table->string('gambar')->nullable()->after('isi'); // menambahkan kolom gambar setelah isi
        });
    }

    public function down(): void
    {
        Schema::table('zhahira_pengumumans', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
