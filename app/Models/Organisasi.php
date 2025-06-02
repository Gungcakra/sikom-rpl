<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $primaryKey = 'id_organisasi';
    protected $fillable = [
        'nama_organisasi',
        'jenis',
        'deskripsi',
        'tahun_berdiri',
    ];

    public function anggotas()
    {
        return $this->hasMany(Anggota::class, 'id_organisasi');
    }

    public function kegiatans()
    {
        return $this->hasMany(Kegiatan::class, 'id_organisasi');
    }

    public function pengumumans()
    {
        return $this->hasMany(Pengumuman::class, 'id_organisasi');
    }

    public function keuangans()
    {
        return $this->hasMany(Keuangan::class, 'id_organisasi');
    }
}
