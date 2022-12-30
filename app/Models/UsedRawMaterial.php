<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsedRawMaterial extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'used_raw_materials';

    protected $fillable = [
        'task',
        'card',
        'factory',
        'rawMaterial',
        'workshop',
        'worker',
        'quantity',
        'inventory',
    ];
}
