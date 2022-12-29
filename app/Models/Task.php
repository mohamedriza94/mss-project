<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Task extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tasks';

    protected $fillable = [
        'taskNo',
        'cardNo',
        'name',
        'description',
        'startDate',
        'endDate',
        'duration',
        'date',
        'time',
        'status',
        'factory',
        'workshop',
    ];
}
