<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraBeasiswa extends Model
{
    use HasFactory;

    protected $table = 'zhahira_beasiswa'; // sesuaikan dengan nama tabel
    protected $fillable = [
        'nama_beasiswa', 'deskripsi', 'kategori_id', 'tanggal_buka', 'tanggal_tutup'
    ];
}
