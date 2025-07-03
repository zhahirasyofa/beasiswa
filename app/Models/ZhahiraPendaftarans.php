<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraPendaftarans extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'nim',
        'prodi',
        'asal_kampus',
        'semester',
        'no_telepon',
        'tanggal_daftar',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function beasiswa()
    {
        return $this->belongsTo(ZhahiraBeasiswas::class, 'beasiswa_id');
    }
}
