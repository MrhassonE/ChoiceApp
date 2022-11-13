<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Country;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Notifications\AddCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all-city-read|country-city-read')->only('index');
        $this->middleware('permission:all-city-create|country-city-create')->only('store');
        $this->middleware('permission:all-city-update|country-city-update')->only('edit','update');
        $this->middleware('permission:all-city-delete|country-city-delete')->only('Active','DisActive');
    }

    public function index(){
        if (auth()->user()->hasPermission('all-city-read')){
            $cities = City::orderByDesc('created_at')->get();
        }elseif (auth()->user()->hasPermission('country-city-read')){
            $cities = City::where('country_id',auth()->user()->country_id)->orderByDesc('created_at')->get();
        }
        $countries = Country::where('is_active',1)->get();
        return view('Dashboard.City.index',compact('cities','countries'));
    }

    public function store(Request $request){
        if (auth()->user()->hasPermission('all-city-create')){
            $request->validate([
                'name'=>'required|max:100',
                'country'=>'required',
            ]);
            $city = City::create([
                'id'=>rand(100000,999999),
                'name'=>$request->name,
                'country_id'=>$request->country,
            ]);
        }elseif (auth()->user()->hasPermission('country-city-create')){
            $request->validate([
                'name'=>'required|max:100',
            ]);
            $city = City::create([
                'id'=>rand(100000,999999),
                'name'=>$request->name,
                'country_id'=>auth()->user()->country_id,
            ]);

        }

        $text = 'تم اضافة مدينة بأسم '.$city->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));

        $g = GeneralSetting::first();
        if ($request->notification && $g->notification ==1){
            try {
                foreach (FCMToken::all() as $user){
                    $user->notify(new AddCity($city->name));
                }
            }catch (\Exception $exception){
            }
        }
    }

    public function edit(City $city){
        return view('Dashboard.City.Edit',compact('city'));
    }

    public function update(Request $request, City $city){
        $request->validate([
            'name'=>'required|max:100',
        ]);
        $city->update($request->all());
        $text = 'تم تعديل المدينة '.$city->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function Active(City $city){
        $city->update(['is_active'=>1]);
        $text = 'تم تفعيل المدينة '.$city->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function DisActive(City $city){
        $city->update(['is_active'=>0]);
        $text = 'تم ايقاف المدينة '.$city->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

}
