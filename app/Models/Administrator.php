<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'administrators';

    protected $fillable = [
        'username',
    ];

    protected $hidden = [
        'password',
    ];
}
