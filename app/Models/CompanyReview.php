<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    use HasFactory;
    protected $fillable = ['id','number','title','user_id','company_id'];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }
    public function User(){
        return $this->belongsTo(User::class,'user_id');
    }
}
