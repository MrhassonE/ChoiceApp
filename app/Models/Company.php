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
        'city_id',
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
    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }


}
