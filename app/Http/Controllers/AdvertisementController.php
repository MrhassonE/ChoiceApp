<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Advertisement;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:all-advertisement-read|country-advertisement-read')->only('index');
        $this->middleware('permission:all-advertisement-create|country-advertisement-create')->only('store');
        $this->middleware('permission:all-advertisement-update|country-advertisement-update')->only('edit','update');
        $this->middleware('permission:all-advertisement-delete|country-advertisement-delete')->only('destroy');
    }

    public function cosFromCitySuper(City $city){
        return Company::where('city_id',$city->id)->where('is_active',1)->get();
    }

    public function index(Request $request){
        if (auth()->user()->hasPermission('all-advertisement-read')) {
            $ads = Advertisement::orderByDesc('created_at')
                ->when($request->company, function ($company) use ($request) {
                    return $company->where('company_id', $request->company);
                })->get();
            $companies = Company::where('is_active', 1)->get();
            $countries = Country::where('is_active',1)->get();

        }elseif (auth()->user()->hasPermission('country-advertisement-read')){
            $ads = Advertisement::orderByDesc('created_at')->where('country_id',auth()->user()->country_id)
                ->when($request->company, function ($company) use ($request) {
                    return $company->where('company_id', $request->company);
                })->get();
            $companies = Company::where('is_active', 1)->where('country_id',auth()->user()->country_id)->get();
            $countries = Country::where('id',auth()->user()->country_id)->where('is_active',1)->first();

        }
        return view('Dashboard.Advertisement.index',compact('ads','companies','countries'));
    }

    public function store(Request $request){
        if (auth()->user()->hasPermission('all-advertisement-create')) {
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png|max:5000',
                'Country' => 'required',
                'City' => 'required',
                'Company' => 'required',
            ]);
            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalName();
                $store = $file->storeAs('Advertisement', $fileName, 'public');
            }
            $advertisement = Advertisement::create([
                'id' => rand(100000, 999999),
                'image' => $fileName,
                'company_id' => $request->Company,
                'city_id' => $request->City,
                'country_id' => $request->Country,
            ]);
        }elseif (auth()->user()->hasPermission('country-advertisement-create')){
            $request->validate([
                'image' => 'required|mimes:jpeg,jpg,png|max:5000',
                'City' => 'required',
                'Company' => 'required',
            ]);
            $fileName = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '.' . $file->getClientOriginalName();
                $store = $file->storeAs('Advertisement', $fileName, 'public');
            }
            $cit = City::findOrFail($request->City);
            $advertisement = Advertisement::create([
                'id' => rand(100000, 999999),
                'image' => $fileName,
                'company_id' => $request->Company,
                'city_id' => $request->City,
                'country_id' => $cit->Country->id,
            ]);
        }
        $com = Company::findOrFail($advertisement->Company->id);
        $text = 'تم اضافة اعلان الى شركة '.$com->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(Advertisement $advertisement){
        if (auth()->user()->hasPermission('all-advertisement-update')) {
            $companies = Company::where('is_active', 1)->get();
        }elseif (auth()->user()->hasPermission('country-advertisement-update')){
            $companies = Company::where('is_active', 1)->where('country_id',auth()->user()->country_id)->get();
        }
        return view('Dashboard.Advertisement.edit',compact('advertisement','companies'));
    }
    public function update(Request $request, Advertisement $advertisement){
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png|max:5000',
            'company_id'=>'required',
        ]);
        if ($request->hasFile('image')) {
            $path = 'storage/Advertisement/'.$advertisement->image;
            if (File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs('Advertisement',$fileName,'public');
            $advertisement->image = $fileName;
        }
        $advertisement->update($request->except('image'));

        $com = Company::findOrFail($request->company_id);
        $text = 'تم تعديل اعلان الى شركة '.$com->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function destroy(Advertisement $advertisement){
        $path = 'storage/Advertisement/'.$advertisement->image;
        File::delete($path);

        $com = Company::findOrFail($advertisement->company_id);
        $text = 'تم حذف اعلان شركة '.$com->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $advertisement->delete();
    }
}
