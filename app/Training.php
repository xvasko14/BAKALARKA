<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Team extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'teamTraining_id','starts','date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $casts = [
        'date' => 'hh:mm'
    ];

}
