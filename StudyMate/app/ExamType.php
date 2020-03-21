<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    public $timestamps = false;

    const EXAM = 1;
    const ASSESSMENT = 2;
    const ASSIGNMENT =3 ;
    public function exams(){
        return $this->belongsToMany('App\Exam');
    }
}
