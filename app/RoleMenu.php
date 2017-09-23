<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    protected $table = 'role_menu';

    public function menus(){
        return $this->hasMany('App\Menu');
    }

    public function roles(){
        return $this->hasMany('App\Role');
    }
}
