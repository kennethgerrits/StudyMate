<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Module extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'overseer', 'taught_by'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
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

    public function setOverseerAttribute($value)
    {
        $this->attributes['overseer'] = Crypt::encryptString($value);
    }

    public function getOverseerAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setTaughtByAttribute($value)
    {
        $this->attributes['taught_by'] = Crypt::encryptString($value);
    }

    public function getTaughtByAttribute($value)
    {
        return Crypt::decryptString($value);
    }

}
