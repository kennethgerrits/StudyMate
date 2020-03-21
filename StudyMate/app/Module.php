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
        'name', 'overseer', 'taught_by'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function overseer(){
        return $this->belongsTo('App\User', 'overseer');
    }
    public function teacher(){
        return $this->belongsTo('App\User', 'taught_by');
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
