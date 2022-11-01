<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'company_name',
        'company_logo',
        'policy',
        'conditions',
        'email',
        'phone',
        'phone2',
        'facebook',
        'instagram',
        'telegram',
        'whatsapp',
    ];
    protected $appends = ['company_logo_path'];
    public function getCompanyLogoPathAttribute() {
        return asset('storage/Setting/'.$this->company_logo);
    }
}
