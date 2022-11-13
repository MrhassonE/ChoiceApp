<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CustomNotification;
use App\Models\Department;
use App\Models\FCMToken;
use App\Notifications\CustomNotify;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notification-read')->only('index');
        $this->middleware('permission:notification-create')->only('store');
    }

    public function index(){
        if (auth()->user()->hasPermission('all-department-read')) {
            $customNotifications = CustomNotification::all();
            $deps = Department::where('is_active', 1)->get();
            $cos = Company::where('is_active', 1)->get();
        }elseif (auth()->user()->hasPermission('country-department-read')) {
            $customNotifications = CustomNotification::orderByDesc('created_at')->where('country_id',auth()->user()->country_id)->get();
            $deps = Department::where('is_active', 1)->where('country_id',auth()->user()->country_id)->get();
            $cos = Company::where('is_active', 1)->where('country_id',auth()->user()->country_id)->get();
        }
        return view('Dashboard.CustomNotification.index',compact('customNotifications','deps','cos'));
    }
    public function store(Request $request){

        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required|max:500',
            'type'=>['required',Rule::in([1,2]),],
        ]);
        $type = $request->type;
        if ($type == 1){
            $data = Department::find($request->department);
            $notification = CustomNotification::create([
                'title'=>$request->title,
                'body'=>$request->body,
                'type'=>$request->type,
                'department_id'=>$request->department,
                'country_id'=>$data->Country->id
            ]);
            try {
                foreach (FCMToken::all() as $user){
                    $user->notify(new CustomNotify($notification->title,$notification->body,$data,$type));
                }
            }catch (\Exception $exception){

            }
        }elseif ($type == 2){
            $data = Company::find($request->company);
            $notification = CustomNotification::create([
                'title'=>$request->title,
                'body'=>$request->body,
                'type'=>$request->type,
                'company_id'=>$request->company,
                'country_id'=>$data->Country->id
            ]);
            try {
                foreach (FCMToken::all() as $user){
                    $user->notify(new CustomNotify($notification->title,$notification->body,$data,$type));
                }
            }catch (\Exception $exception){
            }
        }
    }
}
