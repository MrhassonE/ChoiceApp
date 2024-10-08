<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','is_active','country_id'];

    public function Country(){
        return $this->belongsTo(Country::class,'country_id');
    }
    public function Department(){
        return $this->hasMany(Department::class,'city_id');
    }
    public function Company(){
        return $this->hasMany(Company::class,'city_id');
    }
}
