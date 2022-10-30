<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Company;
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
        $this->middleware('permission:department-update')->only('edit','update','show');
        $this->middleware('permission:department-delete')->only('DisActive','Active','destroy');
        $this->middleware('permission:company-create')->only('storeCompany');
    }

    public function index(){
        $departments = Department::orderByDesc('created_at')->get();
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
            'id'=>rand(100000,999999),
            'name'=>$request->name,
            'city_id'=>$request->city_id,
            'image'=>$fileName,
        ]);
        $text = 'تم اضافة قسم بعنوان '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(Department $department){
        $cities = City::where('is_active',1)->get();
        return view('Dashboard.Department.Edit',compact('department','cities'));
    }
    public function update(Request $request, Department $department){
        $request->validate([
            'name'=>'required|max:500',
            'city_id'=>'required',
            'image' => 'mimes:jpeg,jpg,png|max:5000',
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

    public function show(Department $department){
        $companies = Company::where('department_id',$department->id)->orderByDesc('created_at')->get();
        return view('Dashboard.Department.show',compact('department','companies'));
    }

    public function storeCompany(Request $request, Department $department){
        $request->validate([
            'name'=>'required|max:100',
            'image' => 'required|mimes:jpeg,jpg,png|max:5000',
            'email'=>'required|email|max:100',
            'phone'=>'required|max:30',
            'address'=>'required|max:500',
            'facebook'=>'max:150',
            'instagram'=>'max:150',
            'telegram'=>'max:150',
            'whatsapp'=>'max:150',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('Company',$fileName,'public');
        }

        $company = Company::create([
            'id'=>rand(100000,999999),
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'facebook'=>$request->facebook,
            'instagram'=>$request->instagram,
            'telegram'=>$request->telegram,
            'whatsapp'=>$request->whatsapp,
            'department_id'=>$department->id,
            'city_id'=>$department->City->id,
            'image'=>$fileName,
        ]);
        $text = 'تم اضافة شركة بعنوان '.$company->name.' الى قسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function Active(Department $department){
        $department->update(['is_active'=>1]);

        $text = 'تم تفعيل القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function DisActive(Department $department){
        $department->update(['is_active'=>0]);

        $text = 'تم ايقاف القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function destroy(Department $department){
        $path = 'storage/Department/'.$department->image;
        File::delete($path);

        $text = 'تم حذف القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $department->delete();
    }
}
