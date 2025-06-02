<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = [
        'id_organisasi',
        'nama_kegiatan',
        'deskripsi',
        'tanggal_pelaksanaan',
        'kuota_peserta',
        'lokasi',
        'status',
    ];
    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi');
    }

    public function pendaftaranKegiatans()
    {
        return $this->hasMany(PendaftaranKegiatan::class, 'id_kegiatan');
    }
}
