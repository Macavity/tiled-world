<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Character\Character;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active_character'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function characters(){
        return $this->hasMany(Character::class);
    }
}
