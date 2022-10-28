<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:department-read')->only('index');
        $this->middleware('permission:department-create')->only('store');
        $this->middleware('permission:department-update')->only('edit','update');
        $this->middleware('permission:department-delete')->only('CityDelete');
    }

    public function index(){
        $departments = Department::all();
        $cities = City::where('is_active',1)->get();
        return view('Dashboard.Department.index',compact('departments','cities'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|max:500',
            'city_id'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:5000',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('Department',$fileName,'public');
        }

        $department = Department::create([
            'name'=>$request->name,
            'city_id'=>$request->city_id,
            'image'=>$fileName,
        ]);
        $text = 'تم اضافة قسم بعنوان '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(Department $department){
        return view('Dashboard.Department.Edit',compact('department'));
    }

    public function update(Request $request, Department $department){
        $request->validate([
            'name'=>'required|max:500',
            'city_id'=>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:5000',
        ]);
        if ($request->hasFile('image')) {
            $path = 'storage/Department/'.$department->image;
            if (File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs('Department',$fileName,'public');
            $department->image = $fileName;
        }
        $department->update($request->except('image'));

        $text = 'تم تعديل القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function Active(Department $department){

        $text = 'تم تفعيل القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $department->update(['is_active'=>1]);
    }
    public function DisActive(Department $department){

        $text = 'تم ايقاف القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $department->update(['is_active'=>0]);
    }
}
