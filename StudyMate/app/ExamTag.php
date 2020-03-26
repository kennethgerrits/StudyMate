<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamTag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'exam_id', 'tag_id'
    ];
}
