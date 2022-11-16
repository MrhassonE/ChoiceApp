<?php

namespace App\Http\Controllers;
use App\Models\Advertisement;
use App\Models\AllVisit;
use App\Models\City;
use App\Models\Company;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Department;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Models\WhatsNew;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class APIController extends Controller
{
    protected function fcmToken(Request $request){
        $request->validate([
            'fcm_token'=>'required|min:10',
            'type'=>'required'
        ]);
        $fcm = FCMToken::where('fcm_token',$request->fcm_token)->first();
        if (!$fcm){
            $fcm = FCMToken::create([
                'fcm_token'=>$request->fcm_token,
                'type'=>$request->type,
            ]);
        }
        return response()->json(['success'=>'true'], 200);
    }

    protected function getCities(){
        return Country::where('is_active',1)->with('City',function ($q){
            return $q->where('is_active',1)->get();
        })->get(["id","name"]);
    }
    protected function getDepartmentCityById($cId,$id){
        if ($id =='allcities') {
            return Department::where('country_id', $cId)->where('is_active', 1)->where('is_main', 1)->orderByDesc('created_at')
                ->with(['SubDepartment' => function ($query) {
                    $query->with(['Company' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id', 'sub_department_id')
                            ->where('is_active', 1)->get();
                    }])
                        ->with(['CompanyMostViewed' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id','sub_department_id')
                            ->where('most_viewed', 1)->where('is_active', 1)->get();
                    }])->where('is_active', 1)->get();
                }])
                ->with(['Company'=>function($query){
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('is_active', 1)->get();
                }])
                ->with(['CompanyMostViewed' => function ($query) {
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('most_viewed', 1)->where('is_active', 1)->get();
                }])->select('id', 'name', 'image')->get();

        }else{
            return Department::where('country_id', $cId)->where('is_active', 1)->where('is_main', 1)->orderByDesc('created_at')->where('city_id', $id)
                ->with(['SubDepartment' => function ($query) {
                    $query->with(['Company' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id', 'sub_department_id')
                            ->where('is_active', 1)->get();
                    }])
                        ->with(['CompanyMostViewed' => function ($query) {
                            $query->with(['CompanyImages' => function ($query) {
                                $query->select('id', 'image', 'company_id')->get();
                            }])->
                            select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id','sub_department_id')
                                ->where('most_viewed', 1)->where('is_active', 1)->get();
                        }])->where('is_active', 1)->get();
                }])
                ->with(['Company'=>function($query){
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('is_active', 1)->get();
                }])
                ->with(['CompanyMostViewed' => function ($query) {
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('most_viewed', 1)->where('is_active', 1)->get();
                }])
                ->select('id', 'name', 'image')->get();
        }
    }
    protected function getDepartments($cId,$id){
        if ($id =='allcities'){
            return Department::where('is_active',1)->where('country_id',$cId)->orderByDesc('created_at')->get(["id","name",'image']);
        }else{
            return Department::where('is_active',1)->where('city_id',$id)->where('country_id',$cId)->orderByDesc('created_at')->get(["id","name",'image']);
        }
    }
    protected function getSettings(){
        $cities=Country::where('is_active',1)->with('City',function ($q){
            return $q->where('is_active',1)->get();
        })->get(["id","name"]);
        $setting= GeneralSetting::get(['company_name','company_logo','email','phone','phone2','facebook','instagram','telegram','whatsapp','policy','conditions','android_app','ios_app']);
        $whatsNew = WhatsNew::get(['title']);
        $res=Collect(["cities"=>$cities]);
        $res=$res->merge(["settings"=>$setting]);
        $res=$res->merge(["whatsNew"=>$whatsNew]);
        return $res->all();
    }
    protected function getCompanies($cId){
        return Company::where('is_active',1)->where('country_id',$cId)->orderByDesc('created_at')->get([
            'name',
            'email',
            'phone',
            'address',
            'image',
            'evaluation',
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
    protected function getCompaniesCityById($cId,$id){
        if ($id =='allcities'){
            return Company::where('is_active',1)->where('country_id',$cId)->orderByDesc('created_at')->get([
                'name','email','phone','address','image','evaluation','products','services',
                'facebook','instagram','telegram','whatsapp',
                //'department_id',
                //'city_id'
            ]);
        }else{
            return Company::where('is_active',1)->where('country_id',$cId)->where('city_id', $id)->orderByDesc('created_at')->get([
                'name','email','phone','address','image','evaluation','products','services',
                'facebook','instagram','telegram','whatsapp',
                //'department_id',
                //'city_id'
            ]);
        }

    }
    protected function getCompaniesCityByDep($dep){
        return Company::where('is_active',1)->where('department_id', $dep)->with(['CompanyImages'=>function($query) {
            $query->select('id','image','company_id')->orderByDesc('created_at')->get();
        }])->orderByDesc('created_at')->select('id','name','email','phone','address','image','evaluation','products','services', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();
    }
    protected function getAdvertisements($cId,$id){
        if ($id == 'allcities') {
            return Advertisement::where('country_id', $cId)->with(['Company' => function ($query) {
                $query->where('is_active', 1)->select('id')->get();
            }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);
        }else{
            return Advertisement::where('city_id',$id)->where('country_id', $cId)->with(['Company' => function ($query) {
                $query->where('is_active', 1)->select('id')->get();
            }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);
        }
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
        return response()->json(['err'=>'true'], 200);
    }
    protected function home($cId,$id){
        if ($id == 'allcities'){
            $dep = Department::where('country_id', $cId)->where('is_active', 1)->where('is_main', 1)->orderByDesc('created_at')
                ->with(['SubDepartment' => function ($query) {
                    $query->with(['Company' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id', 'sub_department_id')
                            ->where('is_active', 1)->get();
                    }])
                        ->with(['CompanyMostViewed' => function ($query) {
                            $query->with(['CompanyImages' => function ($query) {
                                $query->select('id', 'image', 'company_id')->get();
                            }])->
                            select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id','sub_department_id')
                                ->where('most_viewed', 1)->where('is_active', 1)->get();
                        }])->where('is_active', 1)->get();
                }])
                ->with(['Company'=>function($query){
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('is_active', 1)->get();
                }])
                ->with(['CompanyMostViewed' => function ($query) {
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('most_viewed', 1)->where('is_active', 1)->get();
                }])->select('id', 'name', 'image')->get();


            $company1 = Company::where('country_id', $cId)->where('is_active', 1)->where('most_viewed', 1)->orderByDesc('created_at')->where('is_main', 1)->with(['CompanyImages' => function ($query) {
                $query->select('id', 'image', 'company_id')->get();
            }])->select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

            $company2 = Company::where('country_id', $cId)->where('is_active', 1)->where('new', 1)->orderByDesc('created_at')->with(['CompanyImages' => function ($query) {
                $query->select('id', 'image', 'company_id')->get();
            }])->select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

            $ad = Advertisement::where('country_id', $cId)->with(['Company' => function ($query) {
                $query->where('is_active', 1)->with(['CompanyImages' => function ($query) {
                    $query->select('id', 'image', 'company_id')->get();
                }])->
                select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                    ->get();
            }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);

        }else {

            $dep = Department::where('country_id', $cId)->where('is_active', 1)->where('is_main', 1)->orderByDesc('created_at')->where('city_id', $id)
                ->with(['SubDepartment' => function ($query) {
                    $query->with(['Company' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id', 'sub_department_id')
                            ->where('is_active', 1)->get();
                    }])
                    ->with(['CompanyMostViewed' => function ($query) {
                        $query->with(['CompanyImages' => function ($query) {
                            $query->select('id', 'image', 'company_id')->get();
                        }])->
                        select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id','sub_department_id')
                            ->where('most_viewed', 1)->where('is_active', 1)->get();
                    }])->where('is_active', 1)->get();
                }])
                ->with(['Company'=>function($query){
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('is_active', 1)->get();
                }])
                ->with(['CompanyMostViewed' => function ($query) {
                    $query->with(['CompanyImages' => function ($query) {
                        $query->select('id', 'image', 'company_id')->get();
                    }])->
                    select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                        ->where('most_viewed', 1)->where('is_active', 1)->get();
                }])
                ->select('id', 'name', 'image')->get();

            $company1 = Company::where('country_id', $cId)->where('is_active', 1)->where('most_viewed', 1)->orderByDesc('created_at')->where('is_main', 1)->where('city_id', $id)->with(['CompanyImages' => function ($query) {
                $query->select('id', 'image', 'company_id')->get();
            }])->select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

            $company2 = Company::where('country_id', $cId)->where('is_active', 1)->where('new', 1)->orderByDesc('created_at')->where('city_id', $id)->with(['CompanyImages' => function ($query) {
                $query->select('id', 'image', 'company_id')->get();
            }])->select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp')->get();

            $ad = Advertisement::where('country_id', $cId)->where('city_id', $id)->with(['Company' => function ($query) {
                $query->where('is_active', 1)->with(['CompanyImages' => function ($query) {
                    $query->select('id', 'image', 'company_id')->get();
                }])->
                select('id', 'name', 'email', 'phone', 'address', 'image', 'evaluation', 'products', 'services', 'latitude', 'longitude', 'facebook', 'instagram', 'telegram', 'whatsapp', 'department_id')
                    ->get();
            }])->orderByDesc('created_at')->get(['image', 'company_id', 'created_at']);

        }
        $res = Collect(["dep" => $dep]);
        $res = $res->merge(["ad" => $ad]);
        $res = $res->merge(["company_most_viewed" => $company1]);
        $res = $res->merge(["company_new" => $company2]);
        return $res->all();
    }
    protected function visit(Request $request){
        $request->validate([
            'ip_address'=>'required',
            'phone_type'=>'required',
        ]);
        AllVisit::create([
            'ip_address'=>$request->ip_address,
            'phone_type'=>$request->phone_type,
        ]);
        return response()->json(['success'=>'true'], 200);

    }
}
