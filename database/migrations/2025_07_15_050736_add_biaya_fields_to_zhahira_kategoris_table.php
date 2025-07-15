<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('zhahira_kategoris', function (Blueprint $table) {
            $table->integer('biaya_hidup')->nullable()->after('nama');
            $table->integer('biaya_pendidikan')->nullable()->after('biaya_hidup');
        });
    }

    public function down()
    {
        Schema::table('zhahira_kategoris', function (Blueprint $table) {
            $table->dropColumn('biaya_hidup');
            $table->dropColumn('biaya_pendidikan');
        });
    }
};
