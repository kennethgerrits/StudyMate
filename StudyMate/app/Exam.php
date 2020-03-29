<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Exam extends Model
{
    public $timestamps = false;
    //

    protected $fillable = [
        'description', 'deadline_date', 'appendix', 'is_finished', 'module_id', 'examtype_id', 'tag_id'
    ];

    public function type()
    {
        return $this->belongsTo('App\ExamType', 'examtype_id');
    }

    public function module()
    {
        return $this->belongsTo('App\Module');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /*Encryption Mutators*/
    public function setAppendixAttribute($value)
    {
        $this->attributes['Appendix'] = Crypt::encryptString($value);
    }

    public function getAppendixAttribute($value)
    {
        if ($value == null) {
            return;
        }
        return Crypt::decryptString($value);
    }

}
