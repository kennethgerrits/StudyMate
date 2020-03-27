<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    public $timestamps = false;

    const EXAM = 1;
    const ASSESSMENT = 2;
    const ASSIGNMENT = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
    ];

    public function exams()
    {
        return $this->belongsToMany('App\Exam');
    }
}
