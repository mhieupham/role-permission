<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permission(){
        return $this->belongsToMany('App\Premission','premission_role');
    }
}
