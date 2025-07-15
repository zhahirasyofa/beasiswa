<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraBeasiswas extends Model
{
    use HasFactory;

    protected $table = 'zhahira_beasiswas';

    protected $fillable = [
        'nama_beasiswa',
        'deskripsi',
        'kuota',
        'tanggal_mulai',
        'tanggal_selesai',
        'kategori_id', // <- penting agar bisa mass-assignment
    ];

    // Relasi: satu beasiswa dimiliki oleh satu kategori
    public function kategori()
    {
        return $this->belongsTo(ZhahiraKategoris::class, 'kategori_id');
    }
    
}
