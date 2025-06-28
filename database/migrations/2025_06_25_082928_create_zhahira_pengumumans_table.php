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
    Schema::create('zhahira_pengumumans', function (Blueprint $table) {
        $table->id();
        $table->string('judul');
        $table->text('isi');
        $table->foreignId('kategori_id')->constrained('zhahira_kategoris')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zhahira_pengumumans');
    }
};
