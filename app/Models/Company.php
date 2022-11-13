<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'address',
        'image',
        'facebook',
        'instagram',
        'telegram',
        'whatsapp',
        'department_id',
        'sub_department_id',
        'city_id',
        'country_id',
        'is_active',
        'evaluation',
        'most_viewed',
        'new',
        'is_main',
        'products',
        'services',
        'latitude',
        'longitude',
    ];
    protected $appends = ['img_path'];
    public function getImgPathAttribute() {
        return asset('storage/Company/'.$this->image);
    }

    public function CompanyImages(){
        return $this->hasMany(CompanyImages::class,'company_id');
    }
    public function Advertisement(){
        return $this->hasMany(Advertisement::class,'company_id');
    }
    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function SubDepartment(){
        return $this->belongsTo(SubDepartment::class,'sub_department_id');
    }
    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function Country(){
        return $this->belongsTo(Country::class,'country_id');
    }


}
