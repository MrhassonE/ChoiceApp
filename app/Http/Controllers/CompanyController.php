<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Company;
use App\Models\CompanyImages;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:company-read')->only('index');
        $this->middleware('permission:company-create')->only('store');
        $this->middleware('permission:company-update')->only('edit','update','show','CompanyEvaluation');
        $this->middleware('permission:company-delete')->only('DisActive','Active','destroy');
        $this->middleware('permission:image-create')->only('storeImage');
        $this->middleware('permission:image-delete')->only('deleteImage');
    }

    public function index(Request $request){
        $companies = Company::orderByDesc('created_at')
            ->when($request->dep, function ($dep) use ($request){
                return $dep->where('department_id', $request->dep);
            })->get();


        $departments = Department::where('is_active',1)->get();
        return view('Dashboard.Company.index',compact('companies','departments'));
    }

    public function store(Request $request){
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
            'department_id'=>'required',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('Company',$fileName,'public');
        }
        $department = Department::find($request->department_id);
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
        $text = 'تم اضافة شركة بعنوان '.$company->name.' الى قسم '.$company->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(Company $company){
        $departments = Department::where('is_active',1)->get();
        return view('Dashboard.Company.edit',compact('company','departments'));
    }
    public function update(Request $request, Company $company){
        $request->validate([
            'name'=>'required|max:100',
            'image' => 'mimes:jpeg,jpg,png|max:5000',
            'email'=>'required|email|max:100',
            'phone'=>'required|max:30',
            'address'=>'required|max:500',
            'facebook'=>'max:150',
            'instagram'=>'max:150',
            'telegram'=>'max:150',
            'whatsapp'=>'max:150',
            'department_id'=>'required',
        ]);
        if ($request->hasFile('image')) {
            $path = 'storage/Company/'.$company->image;
            if (File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs('Company',$fileName,'public');
            $company->image = $fileName;
        }
        $company->update($request->except('image'));

        $text = 'تم تعديل الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function CompanyEvaluation(Request $request, Company $company){
        $request->validate([
            'evaluation'=>'required',
        ]);
        $company->update(['evaluation'=>$request->evaluation]);

    }
    public function storeImage(Request $request, Company $company){
        $request->validate([
            'image'=>'required|mimes:jpeg,jpg,png|max:5000',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('Company',$fileName,'public');
        }

        $image = CompanyImages::create([
            'id'=>rand(100000,999999),
            'image'=>$fileName,
            'company_id'=>$company->id,
        ]);

    }
    public function deleteImage(CompanyImages $image){
        $path = 'storage/Company/'.$image->image;
        File::delete($path);
        $image->delete();
    }

    public function show(Company $company){
        $companyImages = CompanyImages::where('company_id',$company->id)->orderByDesc('created_at')->get();
        return view('Dashboard.Company.show',compact('company','companyImages'));
    }

    public function Active(Company $company){

        $company->update(['is_active'=>1]);
        $text = 'تم تفعيل الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }
    public function DisActive(Company $company){

        $company->update(['is_active'=>0]);
        $text = 'تم ايقاف الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function destroy(Company $company){
        $path = 'storage/Company/'.$company->image;
        File::delete($path);

        $text = 'تم حذف الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $company->delete();
    }
}
