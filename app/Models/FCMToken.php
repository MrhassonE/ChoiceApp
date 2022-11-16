<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class FCMToken extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'fcm_token',
        'type'
    ];
}
