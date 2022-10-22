<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    protected $fillable = ['id','image'];
    protected $appends = ['img_path'];
    public function getImgPathAttribute() {
        return asset('storage/Advertisement/'.$this->image);
    }
}
