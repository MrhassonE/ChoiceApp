<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Country;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superAdministrator');
    }

    public function index(){
        $countries = Country::orderByDesc('created_at')->get();
        return view('Dashboard.Country.index',compact('countries'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:100',
        ]);
        $city = Country::create([
            'id'=>rand(100000,999999),
            'name'=>$request->name
        ]);

        $text = 'تم اضافة دولة بأسم '.$city->name;
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

    public function edit(Country $country){
        return view('Dashboard.Country.Edit',compact('country'));
    }

    public function update(Request $request, Country $country){
        $request->validate([
            'name'=>'required|max:100',
        ]);
        $country->update($request->all());
        $text = 'تم تعديل الدولة '.$country->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function Active(Country $country){

        $country->update(['is_active'=>1]);
        $text = 'تم تفعيل الدولة '.$country->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function DisActive(Country $country){

        $country->update(['is_active'=>0]);
        $text = 'تم ايقاف الدولة '.$country->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

}
