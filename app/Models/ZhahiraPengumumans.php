<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZhahiraPengumumans extends Model
{
    use HasFactory;

    protected $table = 'zhahira_pengumumans';

    protected $fillable = [
        'judul',
        'isi',
        'kategori_id',
        'gambar',
    ];

    public function kategori()
    {
        return $this->belongsTo(ZhahiraKategoris::class, 'kategori_id');
    }
}
