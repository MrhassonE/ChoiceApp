<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'type',
        'department_id',
        'company_id',
        'country_id'
    ];

    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function Country(){
        return $this->belongsTo(Country::class,'country_id');
    }
}
