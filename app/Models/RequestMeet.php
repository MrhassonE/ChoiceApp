<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestMeet extends Model
{
    use HasFactory;
    protected $fillable = ['id','service_id','company_id','user_id','date','time'];

    public function CompanyService(){
        return $this->belongsTo(CompanyService::class,'service_id');
    }
    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
