<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\City;
use App\Models\Company;
use App\Models\CompanyBlog;
use App\Models\Country;
use App\Models\FCMToken;
use App\Models\GeneralSetting;
use App\Notifications\AddCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class CompanyBlogController extends Controller
{
    public function index(Company $company){
        $blogs = CompanyBlog::where('company_id',$company->id)->orderByDesc('created_at')->get();
        return view('Dashboard.Company.Blog.index',compact('blogs'));
    }

    public function store(Request $request, Company $company){
        $request->validate([
            'title'=>'required|max:150',
            'image'=>'required|mimes:jpeg,jpg,png|max:5000',
            'description'=>'required',
        ]);

        $fileName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' .$file->getClientOriginalName();
            $store = $file->storeAs('CompanyBlog',$fileName,'public');
        }
        $blog = CompanyBlog::create([
            'title'=>$request->title,
            'description'=>$request->description,
            'image'=>$fileName,
            'company_id'=>$company->id,
            'department_id'=>$company->Department->id,
        ]);
    }

    public function update(Request $request, CompanyBlog $companyBlog){
        $request->validate([
            'title'=>'required|max:150',
            'description'=>'required',
            'image' => 'mimes:jpeg,jpg,png|max:5000',
        ]);
        if ($request->hasFile('image')) {
            $path = 'storage/CompanyBlog/'.$companyBlog->image;
            if (File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('image');
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs('CompanyBlog',$fileName,'public');
            $companyBlog->image = $fileName;
        }
        $companyBlog->update($request->except('image'));
    }

    public function destroy(CompanyBlog $companyBlog){
        $path = 'storage/CompanyBlog/'.$companyBlog->image;
        File::delete($path);
        $companyBlog->delete();
    }

}
