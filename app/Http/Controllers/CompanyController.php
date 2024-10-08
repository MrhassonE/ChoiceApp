<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyImages;
use App\Models\Country;
use App\Models\Department;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Models\SubDepartment;
use App\Notifications\AddCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all-company-read|country-company-read')->only('index');
        $this->middleware('permission:all-company-create|country-company-create')->only('store');
        $this->middleware('permission:all-company-update|country-company-update')->only('edit','update','show','NewSection','MostViewedSection','mainSection');
        $this->middleware('permission:all-company-delete|country-company-delete')->only('DisActive','Active','destroy');
        $this->middleware('permission:image-create')->only('storeImage');
        $this->middleware('permission:image-delete')->only('deleteImage');
    }

    public function coCitiesSuper(Country $country){
        return City::where('country_id',$country->id)->where('is_active',1)->get();
    }
    public function coCountiesSuper(Country $country){
        return Company::where('country_id',$country->id)->where('is_active',1)->get();
    }
    public function coDepsSuper(City $city){
        return Department::where('city_id',$city->id)->where('is_active',1)->get();
    }

    public function index(Request $request){
        if (auth()->user()->hasPermission('all-company-read')) {
            $companies = Company::orderByDesc('created_at')
                ->when($request->FilterCountry, function ($FilterCountry) use ($request) {
                    return $FilterCountry->where('country_id', $request->FilterCountry);
                })
                ->when($request->FilterCity, function ($FilterCity) use ($request) {
                    return $FilterCity->where('city_id', $request->FilterCity);
                })
                ->when($request->filterDep, function ($dep) use ($request) {
                    return $dep->where('department_id', $request->filterDep);
                })
                ->when($request->new, function ($new) use ($request) {
                    return $new->where('new', 1);
                })
                ->when($request->most_viewed, function ($most_viewed) use ($request) {
                    return $most_viewed->where('most_viewed', 1);
                })
                ->when($request->main, function ($main) use ($request) {
                    return $main->where('is_main', 1);
                })
                ->get();
            $departments = Department::where('is_active',1)->get();
            $filterCountries = Country::where('is_active',1)->get();

        }elseif (auth()->user()->hasPermission('country-company-read')){
            $companies = Company::orderByDesc('created_at')->where('country_id',auth()->user()->country_id)
                ->when($request->dep, function ($dep) use ($request) {
                    return $dep->where('department_id', $request->dep);
                })
                ->when($request->new, function ($new) use ($request) {
                    return $new->where('new', 1);
                })
                ->when($request->most_viewed, function ($most_viewed) use ($request) {
                    return $most_viewed->where('most_viewed', 1);
                })
                ->when($request->main, function ($main) use ($request) {
                    return $main->where('is_main', 1);
                })
                ->get();
            $departments = Department::where('is_active',1)->where('country_id',auth()->user()->country_id)->get();
            $filterCountries = Country::where('id',auth()->user()->country_id)->where('is_active',1)->first();
        }
        $countries = Country::where('is_active',1)->get();
        return view('Dashboard.Company.index',compact('companies','departments','countries','filterCountries'));
    }

    public function store(Request $request){
        if (auth()->user()->hasPermission('all-company-create')){
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
                'City' => 'required',
                'Country'=>'required',
                'Department'=>'required',
                'products'=>'min:0',
                'services'=>'min:0',
            ]);

            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' .$file->getClientOriginalName();
                $store = $file->storeAs('Company',$fileName,'public');
            }
            $subDepartment = 0;
            if ($request->subDepartment_id){
                $subDepartment = $request->subDepartment;
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
                'city_id'=>$request->City,
                'country_id'=>$request->Country,
                'department_id'=>$request->Department,
                'sub_department_id'=>$subDepartment,
                'image'=>$fileName,
                'evaluation'=>$request->evaluation,
                'products'=>$request->products,
                'services'=>$request->services,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
            ]);
        }elseif (auth()->user()->hasPermission('country-company-create')){
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
                'evaluation'=>'max:1500',
                'department_id'=>'required',
                'products'=>'min:0',
                'services'=>'min:0',
            ]);


            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' .$file->getClientOriginalName();
                $store = $file->storeAs('Company',$fileName,'public');
            }
            $department = Department::find($request->department_id);

            $subDepartment = 0;
            if ($request->subDepartment_id){
                $subDepartment = $request->subDepartment_id;
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
                'sub_department_id'=>$subDepartment,
                'city_id'=>$department->City->id,
                'country_id'=>$department->Country->id,
                'image'=>$fileName,
                'evaluation'=>$request->evaluation,
                'products'=>$request->products,
                'services'=>$request->services,
                'latitude'=>$request->latitude,
                'longitude'=>$request->longitude,
            ]);
        }

        $text = 'تم اضافة شركة بعنوان '.$company->name.' الى قسم '.$company->Department->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));


        $g = GeneralSetting::first();
        if ($request->notification && $g->notification ==1){
            try {
                foreach (FCMToken::all() as $user){
                    $user->notify(new AddCompany($company->name, $company));
                }
            }catch (\Exception $exception) {
            }
        }
    }

    public function edit(Company $company){
        $departments = Department::where('is_active',1)->where('city_id',$company->City->id)->get();
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
            'evaluation'=>'max:1500',
            'department_id'=>'required',
            'products'=>'numeric|min:0',
            'services'=>'numeric|min:0',
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
        if ($request->sub_department_id){
            $company->update([
                'sub_department_id'=>$request->sub_department_id
            ]);
        }else{
            $company->update([
                'sub_department_id'=>null
            ]);
        }
        $text = 'تم تعديل الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
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

    public function NewSection(Company $company){
        if ($company->new == 0){
            $company->update(['new'=>1]);
            $text = 'تم الاضافة الى الجديد للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الاضافة','desc'=>' تم اضافة الشركة الى حقل الجديد']);
        }elseif ($company->new == 1){
            $company->update(['new'=>0]);
            $text = 'تم الأخفاء من الجديد للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الأخفاء','desc'=>' تم أخفاء الشركة من حقل الجديد']);
        }
    }
    public function MostViewedSection(Company $company){

        if ($company->most_viewed == 0){
            $company->update(['most_viewed'=>1]);
            $text = 'تم الاضافة الى الاكثر مشاهدة للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الاضافة','desc'=>' تم اضافة الشركة الى حقل الاكثر مشاهدة']);
        }elseif ($company->most_viewed == 1){
            $company->update(['most_viewed'=>0]);
            $text = 'تم الأخفاء من الاكثر مشاهدة للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الأخفاء','desc'=>' تم أخفاء الشركة من حقل الأكثر مشاهدة']);
        }
    }

    public function mainSection(Company $company){
        if ($company->is_main ==0){
            $company->update(['is_main'=>1]);
            $text = 'تم الاضافة الى الواجهة الرئيسية للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الاضافة','desc'=>' تم اضافة الشركة الى الواجهة الرئيسية']);
        }elseif ($company->is_main ==1){
            $company->update(['is_main'=>0]);
            $text = 'تم الأخفاء من الواجهة الرئيسية للشركة '.$company->name;
            Event::dispatch(new ActivityLog($text,Auth::id()));
            return response(['title'=>'تم الأخفاء','desc'=>' تم أخفاء الشركة من الواجهة الرئيسية']);
        }
    }
    public function destroy(Company $company){
        $path = 'storage/Company/'.$company->image;
        File::delete($path);

        $text = 'تم حذف الشركة '.$company->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $company->Advertisement()->delete();
        $company->CompanyImages()->delete();
        $company->delete();
    }
}
