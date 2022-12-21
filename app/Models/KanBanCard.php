<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class KanBanCard extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'kan_ban_cards';

    protected $fillable = [
        'cardNo',
        'providedBy',
        'factoryNo',
        'status',
        'date',
        'time',
        'title',
        'description',
    ];
}
