<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendaftaranKegiatan extends Model
{
    protected $primaryKey = 'id_pendaftaran';
    protected $fillable = [
        'id_kegiatan',
        'id_anggota',
        'status',
        'tanggal_daftar',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }
}
