<?php

namespace App\Http\Controllers;

use App\Models\CustomNotification;
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
        return view('Dashboard.CustomNotification.index',compact('customNotifications'));
    }
    public function store(Request $request){
        $request->validate([
            'title'=>'required|max:100',
            'body'=>'required|max:500',
        ]);
        $notification = CustomNotification::create([
            'title'=>$request->title,
            'body'=>$request->body,
        ]);

        try {
            foreach (FCMToken::all() as $user){
                $user->notify(new CustomNotify($notification->title,$notification->body));
            }
        }catch (\Exception $exception){

        }
    }
}
