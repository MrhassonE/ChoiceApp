<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CustomNotification;
use App\Models\Department;
use App\Models\FCMToken;
use App\Notifications\CustomNotify;
use Illuminate\Http\Request;

class CustomNotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:notification-read')->only('index');
        $this->middleware('permission:notification-create')->only('store');
    }

    public function index(){
        $customNotifications = CustomNotification::all();
        $deps = Department::where('is_active',1)->get();
        $cos = Company::where('is_active',1)->get();
        return view('Dashboard.CustomNotification.index',compact('customNotifications','deps','cos'));
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required|max:500',
            'type'=>'required',
        ]);
        $type = $request->type;
        if ($type == 1){
            $notification = CustomNotification::create([
                'title'=>$request->title,
                'body'=>$request->body,
                'type'=>$request->type,
                'department_id'=>$request->department
            ]);
            $data = Department::find($request->department);
        }elseif ($type == 2){
            $notification = CustomNotification::create([
                'title'=>$request->title,
                'body'=>$request->body,
                'type'=>$request->type,
                'company_id'=>$request->company,
            ]);
            $data = Company::find($request->company);
        }else{
            $notification = CustomNotification::create([
                'title'=>$request->title,
                'body'=>$request->body,
            ]);
            $data = null;
        }

        try {
            foreach (FCMToken::all() as $user){
                $user->notify(new CustomNotify($notification->title,$notification->body,$data,$type));
            }
        }catch (\Exception $exception){

        }
    }
}
