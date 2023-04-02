<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBlog extends Model
{
    use HasFactory;
    protected $fillable = ['id','title','description','image','company_id','department_id'];
    protected $appends = ['img_path'];
    public function getImgPathAttribute() {
        return asset('storage/CompanyBlog/'.$this->image);
    }

    public function Department(){
        return $this->belongsTo(Department::class,'department_id');
    }
    public function Company(){
        return $this->belongsTo(Company::class,'company_id');
    }
}
