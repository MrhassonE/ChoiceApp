<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Department;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Models\SubDepartment;
use App\Notifications\AddDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class SubDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all-department-create|country-department-create')->only('store');
        $this->middleware('permission:all-department-update|country-department-update')->only('edit','update');
        $this->middleware('permission:all-department-delete|country-department-delete')->only('DisActive','Active','destroy');
    }

    public function index(Department $department){
        return SubDepartment::where('department_id',$department->id)->where('is_active',1)->get();
    }

    public function store(Request $request, Department $department){
        $request->validate([
            'name'=>'required|max:500',
        ]);
        $subDepartment = SubDepartment::create([
            'id'=>rand(100000,999999),
            'name'=>$request->name,
            'department_id'=>$department->id,
            'city_id'=>$department->City->id,
        ]);
        $text = 'تم اضافة فرع بعنوان '.$subDepartment->name.' الى قسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));

        $g = GeneralSetting::first();
        if ($request->notification && $g->notification ==1){
            try {
                foreach (FCMToken::all() as $user){
                    $user->notify(new AddDepartment($department->name,$department));
                }
            }catch (\Exception $exception){
            }
        }
    }
    public function edit(SubDepartment $subDepartment){
        return view('Dashboard.Department.EditSubDepartment',compact('subDepartment'));
    }
    public function update(Request $request, SubDepartment $subDepartment){
        $request->validate([
            'name'=>'required|max:500',
        ]);
        $subDepartment->update($request->all());

        $text = 'تم تعديل الفرع '.$subDepartment->name.' في قسم '.$subDepartment->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function Active(SubDepartment $subDepartment){
        $subDepartment->update(['is_active'=>1]);

        $text = 'تم تفعيل الفرع '.$subDepartment->name.' في قسم '.$subDepartment->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function DisActive(SubDepartment $subDepartment){
        $subDepartment->update(['is_active'=>0]);

        $text = 'تم ايقاف الفرع '.$subDepartment->name.' في قسم '.$subDepartment->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function destroy(SubDepartment $subDepartment){
        $text = 'تم حذف الفرع '.$subDepartment->name.' في قسم '.$subDepartment->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $subDepartment->Company()->delete();
        $subDepartment->delete();
    }
}
