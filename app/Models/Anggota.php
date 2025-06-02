<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $primaryKey = 'id_anggota';
    protected $fillable = [
        'id_user',
        'id_organisasi',
        'nama',
        'nim',
        'no_hp',
        'prodi',
        'tanggal_gabung',
        'status_keanggotaan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi');
    }

    public function pengurus()
    {
        return $this->hasOne(Pengurus::class, 'id_anggota');
    }

    public function pendaftaranKegiatans()
    {
        return $this->hasMany(PendaftaranKegiatan::class, 'id_anggota');
    }
}
