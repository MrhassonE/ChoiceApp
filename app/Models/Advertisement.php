<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = ['id','image','company_id','city_id','country_id'];
    protected $appends = ['img_path'];
    public function getImgPathAttribute() {
        return asset('storage/Advertisement/'.$this->image);
    }

    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }

    public function Country(){
        return $this->belongsTo(Country::class,'country_id');
    }

}
