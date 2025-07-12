<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraKategoris extends Model
{
    use HasFactory;

    protected $table = 'zhahira_kategoris'; // pastikan nama tabel sesuai
    protected $fillable = ['nama']; // sesuaikan dengan kolom tabel

    // Relasi: satu kategori memiliki banyak beasiswa
    public function beasiswas()
    {
        return $this->hasMany(ZhahiraBeasiswas::class, 'kategori_id');
    }
}
