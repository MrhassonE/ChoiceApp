<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function ActivityLog(Request $request){
        $users = User::whereHas('ActivityLog')->get();
        $activities = ActivityLog::orderBy('id','desc')->where(function ($q)use ($request) {
            return $q->when($request->user, function ($user) use ($request) {
                return $user->where('user_id', $request->user);
            });
        })->when($request->start, function ($start) use ($request) {
            return $start->where('created_at','>=', $request->start);
        })
            ->when($request->end, function ($end) use ($request) {
                return $end->where('created_at','<=', $request->end);
            })->get();

        return view('Dashboard.Settings.activityLog',compact('activities','users'));
    }
}
