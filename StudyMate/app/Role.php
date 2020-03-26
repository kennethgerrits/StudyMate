<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;


    protected $fillable = [
        'name'
    ];

    const ADMIN = 1;
    const TEACHER = 2;
    const GUEST = 3;
    public function users(){
        return $this->belongsToMany('App\User');
    }
}
