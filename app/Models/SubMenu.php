<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class SubMenu extends Model
{
    use HasFactory;
    protected $table = 'submenus'; 
    protected $fillable = ['menu_id', 'name', 'route', 'order','permission_id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class)->withDefault();
    }
}
