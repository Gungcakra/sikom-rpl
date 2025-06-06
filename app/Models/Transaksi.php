<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_bank',
        'nominal',
        'jenis_transaksi',
        'keterangan',
    ];
    public function bank()
    {
        return $this->belongsTo(Bank::class, 'id_bank', 'id_bank');
    }
}
