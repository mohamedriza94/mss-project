<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Workshop extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'workshops';

    protected $fillable = [
        'no',
        'departmentNo',
        'name',
        'status',
    ];
}
