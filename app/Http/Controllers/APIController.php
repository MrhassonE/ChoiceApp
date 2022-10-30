<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use App\Models\City;
use App\Models\Company;
use App\Models\ContactUs;
use App\Models\Department;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class APIController extends Controller
{
    protected function getCities(){
        return City::get(["id","name"]);
    }

    protected function getDepartmentCityById($id){
        return Department::where('city_id', $id)->get(["id", "name","image"]);
    }

    protected function getDepartments(){
        return Department::get(["id","name",'image']);
    }

    protected function getSettings(){
        return GeneralSetting::get(['company_name','company_logo','email','phone','phone2','facebook','instagram','telegram','whatsapp','policy','conditions']);
    }

    protected function getCompanies(){
        return Company::get([
            'name',
            'email',
            'phone',
            'address',
            'image',
            'products',
            'services',
            'facebook',
            'instagram',
            'telegram',
            'whatsapp',
            //'department_id',
            //'city_id'
        ]);
    }

    protected function getCompaniesCityById($id){
        return Company::where('city_id', $id)->get([
            'name',
            'email',
            'phone',
            'address',
            'image',
            'products',
            'services',
            'facebook',
            'instagram',
            'telegram',
            'whatsapp',
            //'department_id',
            //'city_id'
        ]);
    }


    protected function getCompaniesCityByDep($dep){
        return Company::where('department_id', $dep)->with(['CompanyImages'=>function($query) {
            $query->select('id','image','company_id')->get();
        }])->select('id','name','email','phone','address','image','products','services', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

    }

    protected function getAdvertisements(){
        return Advertisement::get([
            'image',
            'created_at'
        ]);
    }

    protected function send(Request $request){
        //$validator =
        $request->validate( [
            'message' => 'required|string|max:255'
        ]);
        ContactUs::create($request->all());
        return response()->json(['seccuss'=>'true'], 200);
    }
    protected function home($id){
        $dep=Department::where('city_id', $id)->get(["id", "name","image"]);
        $company=Company::where('city_id', $id)->get([
            'name',
            'email',
            'phone',
            'address',
            'image',
            'products',
            'services',
            'facebook',
            'instagram',
            'telegram',
            'whatsapp',
            //'department_id',
            //'city_id'
        ]);
        $ad=Advertisement::get([
            'image',
            'created_at'
        ]);
        $res=Collect(["dep"=>$dep]);
        $res=$res->merge(["ad"=>$ad]);
        $res=$res->merge(["company"=>$company]);
        return $res->all();
    }
}
