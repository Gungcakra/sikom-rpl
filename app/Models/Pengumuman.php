<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $primaryKey = 'id_pengumuman';
    protected $fillable = [
        'judul',
        'isi',
        'tanggal_post',
        'id_organisasi',
    ];
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi');
    }
}
