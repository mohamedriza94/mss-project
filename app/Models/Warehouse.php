<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Warehouse extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'warehouses';

    protected $fillable = [
        'warehouseNo',
        'location',
        'username',
    ];
    
    protected $hidden = [
        'password',
    ];
}
