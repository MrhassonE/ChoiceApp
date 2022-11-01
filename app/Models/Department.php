<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = ['id','name','image','is_active','is_main','city_id'];
    protected $appends = ['img_path'];
    public function getImgPathAttribute() {
        return asset('storage/Department/'.$this->image);
    }

    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function Company(){
        return $this->hasMany(Company::class,'department_id');
    }
    public function CompanyMostViewed(){
        return $this->hasMany(Company::class,'department_id');
    }
}
