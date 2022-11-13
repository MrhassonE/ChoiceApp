<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:superAdministrator|administrator');
    }

    public function ActivityLog(Request $request){
        if (auth()->user()->hasRole('superAdministrator')){
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
        }elseif (auth()->user()->hasRole('administrator')){
            $users = User::whereHas('ActivityLog')->where('country_id',auth()->user()->country_id)->get();
            $activities = ActivityLog::orderBy('id','desc')->where(function ($q)use ($request) {
                return $q->when($request->user, function ($user) use ($request) {
                    return $user->where('user_id', $request->user);
                });
                })->when($request->start, function ($start) use ($request) {
                    return $start->where('created_at','>=', $request->start);
                })
                ->when($request->end, function ($end) use ($request) {
                    return $end->where('created_at','<=', $request->end);
                })->whereHas('User',function ($query){
                    $query->where('country_id', auth()->user()->country_id);
                })->get();
        }

        return view('Dashboard.Settings.activityLog',compact('activities','users'));
    }
}
