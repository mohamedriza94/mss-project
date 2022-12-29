<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class rawMaterial extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'raw_materials';

    protected $fillable = [
        'no',
        'inventoryNo',
        'status',
        'quantity',
        'minimumQuantity',
        'repurchaseQuantity',
        'checkingStatus',
        'factory',
    ];
}
