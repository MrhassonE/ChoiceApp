<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyVisit extends Model
{
    use HasFactory;
    protected $fillable = ['ip_address','phone_type'];

}
