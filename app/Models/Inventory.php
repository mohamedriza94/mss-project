<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Inventory extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'inventories';

    protected $fillable = [
        'inventoryNo',
        'name',
        'price',
        'status',
        'quantity',
    ];
}
