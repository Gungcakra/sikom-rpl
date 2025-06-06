<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $primaryKey = 'id_bank';
    protected $fillable = [
        'id_organisasi',
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'nominal',
    ];

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class, 'id_organisasi', 'id_organisasi');
    }
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_bank', 'id_bank');
    }
}
