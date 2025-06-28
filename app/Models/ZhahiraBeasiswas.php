<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraBeasiswas extends Model
{
    use HasFactory;

    protected $table = 'zhahira_beasiswas'; // sesuaikan dengan nama tabel
    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'kategori_id',
        'tanggal_buka',
        'tanggal_tutup'
    ];
}
