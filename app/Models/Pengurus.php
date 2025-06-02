<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $primaryKey = 'id_pengurus';
    protected $fillable = [
        'id_anggota',
        'jabatan',
        'periode_mulai',
        'periode_akhir',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
}
