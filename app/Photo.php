<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected  $guarded =[];

    public $dir='/photos/';

    public function user()
    {
        return $this->hasOne('App\User');
    }

    public function getPathAttribute($path)
    {
        return $this->dir . $path;

    }

    public function post()
    {
        return $this->hasOne('App\Post');
    }


}
