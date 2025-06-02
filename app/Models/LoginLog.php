<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    protected $primaryKey = 'id_login_log';
    protected $fillable = [
        'id_user',  
        'waktu_login',
        'waktu_logout',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
