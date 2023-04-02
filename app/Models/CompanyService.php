<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyService extends Model
{
    use HasFactory;
    protected $fillable = ['id','price','title','company_id'];

    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
