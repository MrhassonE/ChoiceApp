<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use App\Models\City;
use App\Models\Company;
use App\Models\ContactUs;
use App\Models\Department;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{
    protected function getCities(){
        return City::where('is_active',1)->get(["id","name"]);
    }

    protected function getDepartmentCityById($id){
        return Department::where('is_active',1)->orderByDesc('created_at')->where('city_id', $id)
            ->with(['Company'=>function($query) {
            $query->with(['CompanyImages'=>function($query) {
                $query->select('id','image','company_id')->get();
            }])->
            select('id','name','email','phone','address','image','products','services','latitude', 'longitude','facebook', 'instagram', 'telegram', 'whatsapp','department_id')
                ->where('is_active',1)->get();
        }])->with(['CompanyMostViewed'=>function($query) {
            $query->with(['CompanyImages'=>function($query) {
                $query->select('id','image','company_id')->get();
            }])->
            select('id','name','email','phone','address','image','products','services','latitude', 'longitude','facebook', 'instagram', 'telegram', 'whatsapp','department_id')
                ->where('most_viewed',1)->where('is_active',1)->get();
        }])->select('id','name','image')->get();
    }

    protected function getDepartments(){
        return Department::where('is_active',1)->orderByDesc('created_at')->get(["id","name",'image']);
    }

    protected function getSettings(){
        $cities=City::where('is_active',1)->get(["id","name"]);
        $setting= GeneralSetting::get(['company_name','company_logo','email','phone','phone2','facebook','instagram','telegram','whatsapp','policy','conditions']);
        $res=Collect(["cities"=>$cities]);
        $res=$res->merge(["settings"=>$setting]);
        return $res->all();
    }

    protected function getCompanies(){
        return Company::where('is_active',1)->orderByDesc('created_at')->get([
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
        return Company::where('is_active',1)->where('city_id', $id)->orderByDesc('created_at')->get([
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
        return Company::where('is_active',1)->where('department_id', $dep)->with(['CompanyImages'=>function($query) {
            $query->select('id','image','company_id')->orderByDesc('created_at')->get();
        }])->orderByDesc('created_at')->select('id','name','email','phone','address','image','products','services', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

    }

    protected function getAdvertisements(){
        return Advertisement::with(['Company'=>function($query) {
            $query->where('is_active',1)->select('id')->get();
        }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);
    }

    protected function send(Request $request){
        //$validator =
        $request->validate([
            'name'=>'required|max:100',
            'email'=>'required|email|max:100',
            'message'=>'required',
        ]);
        $contactForm = ContactUs::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ]);
        $admin = GeneralSetting::first();
        try {
            Mail::to($admin->email)->send(new \App\Mail\ContactUsForm($contactForm->name,$contactForm->email,$contactForm->message));
        }catch (\Exception $exception){
        }
        return response()->json(['seccuss'=>'true'], 200);
    }
    protected function home($id){
        $dep= Department::where('is_active',1)->where('is_main',1)->orderByDesc('created_at')->where('city_id', $id)
            ->with(['Company'=>function($query) {
            $query->with(['CompanyImages'=>function($query) {
                $query->select('id','image','company_id')->get();
            }])->
            select('id','name','email','phone','address','image','products','services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp','department_id')
                ->where('is_active',1)->where('is_main',1)->get();
        }])->with(['CompanyMostViewed'=>function($query) {
                $query->with(['CompanyImages'=>function($query) {
                    $query->select('id','image','company_id')->get();
                }])->
                select('id','name','email','phone','address','image','products','services','latitude', 'longitude','facebook', 'instagram', 'telegram', 'whatsapp','department_id')
                    ->where('most_viewed',1)->where('is_active',1)->get();
            }])->select('id','name','image')->get();


        $company1= Company::where('is_active',1)->where('most_viewed',1)->orderByDesc('created_at')->where('is_main',1)->where('city_id', $id)->with(['CompanyImages'=>function($query) {
            $query->select('id','image','company_id')->get();
        }])->select('id','name','email','phone','address','image','products','services', 'latitude', 'longitude','facebook', 'instagram', 'telegram', 'whatsapp')->get();


        $company2= Company::where('is_active',1)->where('new',1)->orderByDesc('created_at')->where('city_id', $id)->with(['CompanyImages'=>function($query) {
            $query->select('id','image','company_id')->get();
        }])->select('id','name','email','phone','address','image','products','services', 'latitude', 'longitude','facebook', 'instagram', 'telegram', 'whatsapp')->get();

        $ad=Advertisement::with(['Company'=>function($query) {
            $query->where('is_active',1)->select('id')->get();
        }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);

        $res=Collect(["dep"=>$dep]);
        $res=$res->merge(["ad"=>$ad]);
        $res=$res->merge(["company_most_viewed"=>$company1]);
        $res=$res->merge(["company_new"=>$company2]);
        return $res->all();
    }
}
