<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roleUser()
    {
        return $this->hasMany('App\RoleUser');
    }

    public function hasAnyRoles($roles)
    {
        if ($this->roles()->whereIn('name', $roles)->first()) {
            return true;
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public function teacherModules()
    {
        return $this->hasMany('App\Module', 'taught_by', 'id');
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = Crypt::encryptString($value);
    }

    /*Encryption Mutators*/

    public function getNameAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = Crypt::encryptString($value);
    }

    public function getEmailAttribute($value)
    {
        return Crypt::decryptString($value);
    }

    public function getProgressPercentageAttribute()
    {
        $barwidth = '';
        if ($this->getMaxEcAttribute() > 0) {
            $percentage = round(($this->getAchievedEcAttribute() / $this->getMaxEcAttribute() * 100), -1);
        } else {
            $percentage = 0;
        }

        switch ($percentage) {
            case 0:
                $barwidth = 'nullpercent';
                break;
            case 10:
                $barwidth = 'tenpercent';
                break;
            case 20:
                $barwidth = 'twentypercent';
                break;
            case 30:
                $barwidth = 'thirtypercent';
                break;
            case 40:
                $barwidth = 'fourtypercent';
                break;
            case 50:
                $barwidth = 'fiftypercent';
                break;
            case 60:
                $barwidth = 'sixtypercent';
                break;
            case 70:
                $barwidth = 'seventypercent';
                break;
            case 80:
                $barwidth = 'eightypercent';
                break;
            case 90:
                $barwidth = 'ninetypercent';
                break;
            case 100:
                $barwidth = 'onehundredpercent';
                break;
        }

        return $barwidth;
    }

    public function getMaxEcAttribute()
    {
        $maxEC = 0;
        foreach ($this->modules()->get() as $module) {
            $maxEC += $module->study_points;
        }

        return $maxEC;
    }

    public function modules()
    {
        return $this->hasMany('App\Module', 'followed_by', 'id');
    }

    public function getAchievedEcAttribute()
    {
        $achievedEC = 0;
        foreach ($this->modules()->get() as $module) {
            if ($module->is_finished) {
                $achievedEC += $module->study_points;
            }
        }

        return $achievedEC;
    }
}
