<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'employees';

    protected $fillable = [
        'no',
        'departmentNo',
        'name',
        'dob',
        'address',
        'contact',
        'email',
        'role',
        'photo',
    ];

    protected $hidden = [
        'password',
    ];
}
