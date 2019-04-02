<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Player extends Authenticatable
{
    use Notifiable;

    protected $guard = 'player';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // neviem ci tu ma zostat 'club' alebo nie, uvidim pdoal funkcnosti databazy
    protected $fillable = [
        'name', 'email', 'password','age','position','club',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
