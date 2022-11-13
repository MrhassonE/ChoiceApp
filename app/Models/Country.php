<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','is_active'];

    public function City(){
        return $this->hasMany(City::class,'country_id');
    }
}
