<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','is_active','department_id','city_id'];

    public function City(){
        return $this->belongsTo(City::class,'city_id');
    }
    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function Company(){
        return $this->hasMany(Company::class,'sub_department_id');
    }
}
