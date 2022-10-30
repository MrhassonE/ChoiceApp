<?php

namespace App\Http\Controllers;

use App\Models\ConfigEmail;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\File;

class GeneralSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:administrator');
    }
    public function index() {
        $setting_info = GeneralSetting::first();
        $email = ConfigEmail::first();
        return view('Dashboard.Settings.index',compact('setting_info','email'));
    }

    public function SettingInfo(Request $request) {
        $request->validate([
            'company_name'=>'required|max:500',
            'company_logo' => 'mimes:jpeg,jpg,png|max:5000',
        ]);

        $g = GeneralSetting::first();

        if ($request->hasFile('company_logo')) {
            $path = 'storage/Setting/'.$g->company_logo;
            if (File::exists($path)){
                File::delete($path);
            }
            $file = $request->file('company_logo');
            $fileName = time().$file->getClientOriginalName();
            $file->storeAs('Setting',$fileName,'public');
            $g->company_logo = $fileName;
        }

        $g->update($request->except('company_logo','uot_image'));

        $text = 'تم تعديل معلومات الشركة ';
        Event::dispatch(new \App\Events\ActivityLog($text,Auth::id()));
    }
    public function policyConditions(Request $request, GeneralSetting $setting) {
        $request->validate([
            'policy'=>'max:500',
            'conditions' => 'max:500',
        ]);
        $setting->update($request->all());

        $text = 'تم تعديل سياسة الخصوصية وشروط الخدمات ';
        Event::dispatch(new \App\Events\ActivityLog($text,Auth::id()));
    }
    public function updateContact(Request $request) {
        $request->validate([
            'phone'=>'required|max:20',
            'email'=>'required|max:100',
            'facebook'=>'max:500',
            'instagram'=>'max:500',
            'telegram'=>'max:500',
            'whatsapp'=>'max:500',
        ]);
        $g = GeneralSetting::first();

        $g->update($request->all());

        $text = 'تم تعديل معلومات التواصل ';
        Event::dispatch(new \App\Events\ActivityLog($text,Auth::id()));
    }
    public function storeEmail(Request $request) {
        $request->validate([
            'driver' => 'required',
            'host' => 'required',
            'port' => 'required',
            'username' => 'required|email',
            'password' => 'required',
        ]);
        $mail = ConfigEmail::first();
        if(!$mail) {
            ConfigEmail::create($request->all());
        }
        else {
            $mail->update($request->all());
        }
        session()->flash('success','Updated Email Successfully');
        return redirect()->back();
    }
}
