<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Request extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'requests';

    protected $fillable = [
        'requestNo',
        'date',
        'time',
        'status',
        'inventoryNo',
    ];
}
