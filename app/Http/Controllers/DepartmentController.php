<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Department;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Notifications\AddDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all-department-read|country-department-read')->only('index');
        $this->middleware('permission:all-department-create|country-department-create')->only('store');
        $this->middleware('permission:all-department-update|country-department-update')->only('edit','update','show','mainSection');
        $this->middleware('permission:all-department-delete|country-department-delete')->only('DisActive','Active','destroy');
    }

    public function index(Request $request){
        if (auth()->user()->hasPermission('all-department-read')) {
            $departments = Department::orderByDesc('created_at')
                ->when($request->city, function ($city) use ($request) {
                    return $city->where('city_id', $request->city);
                })->get();
            $cities = City::where('is_active',1)->get();

        }elseif (auth()->user()->hasPermission('country-department-read')){
            $departments = Department::orderByDesc('created_at')->where('country_id',auth()->user()->country_id)
                ->when($request->city, function ($city) use ($request) {
                    return $city->where('city_id', $request->city);
                })->get();
            $cities = City::where('is_active',1)->where('country_id',auth()->user()->country_id)->get();
        }
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
        $city = City::find($request->city_id);
        $department = Department::create([
            'id'=>rand(100000,999999),
            'name'=>$request->name,
            'city_id'=>$request->city_id,
            'country_id'=>$city->Country->id,
            'image'=>$fileName,
        ]);
        $text = 'تم اضافة قسم بعنوان '.$department->name;
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

    public function edit(Department $department){
        if (auth()->user()->hasPermission('all-department-update')) {
            $cities = City::where('is_active', 1)->get();
        }elseif (auth()->user()->hasPermission('country-department-update')){
            $cities = City::where('country_id',auth()->user()->country_id)->where('is_active', 1)->get();
        }
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
        return view('Dashboard.Department.show',compact('department'));
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
    public function mainSection(Department $department){
        if ($department->is_main ==0){
            $department->update(['is_main'=>1]);
            $text = 'تم الاضافة الى الواجهة الرئيسية القسم '.$department->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الاضافة','desc'=>' تم اضافة القسم الى الواجهة الرئيسية']);
        }elseif ($department->is_main ==1){
            $department->update(['is_main'=>0]);
            $text = 'تم الأخفاء من الواجهة الرئيسية القسم '.$department->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الأخفاء','desc'=>' تم الأخفاء القسم من الواجهة الرئيسية']);
        }
    }

    public function destroy(Department $department){
        $path = 'storage/Department/'.$department->image;
        File::delete($path);

        $text = 'تم حذف القسم '.$department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $department->Company()->delete();
        $department->delete();
    }
}
