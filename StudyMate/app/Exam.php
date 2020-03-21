<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    public $timestamps = false;
    //

    public function type(){
        return $this->belongsTo('App\ExamType');
    }

    public function module(){
        return $this->belongsTo('App\Module');
    }
}
