<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'role_id'
    ];
    public function user()
    {
        return $this->belongsTo(Exam::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
}
