<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    public function exams(){
        return $this->belongsToMany('App\Exam');
    }
}
