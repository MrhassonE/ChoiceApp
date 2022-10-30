<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:city-read')->only('index');
        $this->middleware('permission:city-create')->only('store');
        $this->middleware('permission:city-update')->only('edit','update');
        $this->middleware('permission:city-delete')->only('Active','DisActive');
    }

    public function index(){
        $cities = City::orderByDesc('created_at')->get();
        return view('Dashboard.City.index',compact('cities'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:100',
        ]);
        $city = City::create([
            'id'=>rand(100000,999999),
            'name'=>$request->name
        ]);

        $text = 'تم اضافة مدينة بأسم '.$city->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
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
