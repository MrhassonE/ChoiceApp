<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Advertisement;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class AdvertisementController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:advertisement-read')->only('index');
        $this->middleware('permission:advertisement-create')->only('store');
        $this->middleware('permission:advertisement-update')->only('edit','update');
        $this->middleware('permission:advertisement-delete')->only('destroy');
    }

    public function index(Request $request){
        $ads = Advertisement::orderByDesc('created_at')
            ->when($request->company, function ($company) use ($request){
                return $company->where('company_id', $request->company);
            })->get();
        $companies = Company::where('is_active',1)->get();
        return view('Dashboard.Advertisement.index',compact('ads','companies'));
    }

    public function store(Request $request){
        $request->validate([
            'image' => 'required|mimes:jpeg,jpg,png|max:5000',
            'company_id'=>'required',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('Advertisement',$fileName,'public');
        }
        $advertisement = Advertisement::create([
            'id'=>rand(100000,999999),
            'company_id'=>$request->company_id,
            'image'=>$fileName,
        ]);
        $com = Company::findOrFail($request->company_id);
        $text = 'تم اضافة اعلان الى شركة '.$com->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(Advertisement $advertisement){
        $companies = Company::where('is_active',1)->get();
        return view('Dashboard.Advertisement.Edit',compact('advertisement','companies'));
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
