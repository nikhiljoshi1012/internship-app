<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticatable
{
    use Notifiable;

    protected $guard = 'professor';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'division'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
