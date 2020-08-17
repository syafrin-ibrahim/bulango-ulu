<?php

namespace App\Models;

use Cartalyst\Sentinel\Roles\EloquentRole as Model;
use Cviebrock\EloquentSluggable\Sluggable;

class RoleUser extends Model
{
    protected $table = 'role_users';

   public function user(){
       return $this->hasOne('App\Models\User', 'id', 'user_id');
   }

    public function role(){
       return $this->hasOne('App\Models\Role', 'id', 'role_id');
   }

}
