<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Module extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'overseer', 'taught_by', 'period_id', 'block_id', 'year', 'study_points', 'is_finished'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function overseer()
    {
        return $this->belongsTo('App\User', 'overseer');
    }

    public function teacher()
    {
        return $this->belongsTo('App\User', 'taught_by');
    }

    public function exams()
    {
        return $this->hasMany('App\Exam', 'module_id');
    }


    /*Encryption Mutators*/
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    public function getNameAttribute($value)
    {
        return Crypt::decryptString($value);
    }

}
