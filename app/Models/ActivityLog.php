<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = ['activity','user_id'];

    public function User()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
