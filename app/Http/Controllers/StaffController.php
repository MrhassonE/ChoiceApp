<?php

namespace App\Http\Controllers;

use App\Events\ActivityLog;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile-read')->only('profile');
        $this->middleware('permission:profile-update|users-update')->only('ChangePassword');
        $this->middleware('permission:profile-update|users-update')->only('update');
        $this->middleware('permission:users-read')->only('index');
        $this->middleware('permission:users-update')->only('edit');
        $this->middleware('permission:users-delete')->only('delete','Active','DisActive');
        $this->middleware('permission:users-create')->only('store');
    }
    public function profile(){
        $user = User::find(Auth::id());
        return view('Dashboard.Staff.profile',compact('user'));
    }

    public function index(){
        $users = User::all();
        $roles = Role::all()->except(1);
        return view('Dashboard.Staff.index',compact('users','roles'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|unique:users|max:100|email',
            'password' => 'required|max:100|min:6',
            'role' => 'required',
        ]);

        $staff = new User([
            'id'=>rand(100000,999999),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->password),
        ]);
        $staff->save();
        $staff->attachRole($request->role);

        $text = 'تم اضافة مستخدم بأسم '.$staff->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function edit(User $user){
        return view('Dashboard.Staff.Edit',compact('user'));
    }
    public function update(Request $request,User $user){
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required','email','max:100',Rule::unique('users')->ignore($user->id)],
        ]);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
        ]);

        $text = 'تم تعديل معلومات المستخدم '.$user->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function ChangePassword(Request $request, User $user){
        $request->validate([
            'passwordEdit' => ['required', Rules\Password::defaults()],
        ]);
        $user->update([
            'password' => Hash::make($request->passwordEdit)
        ]);
        if ($user->id == Auth::id()){
            Auth::logout();
        }

        $text = 'تم تغيير كلمة السر للمستخدم '.$user->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
    }

    public function delete(User $user){

        $text = 'تم حذف المستخدم '.$user->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $user->delete();
    }
    public function Active(User $user){

        $text = 'تم تفعيل المستخدم '.$user->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $user->update(['is_active'=>1]);
    }
    public function DisActive(User $user){

        $text = 'تم ايقاف المستخدم '.$user->name;
        Event::dispatch(new ActivityLog($text,Auth::id()));
        $user->update(['is_active'=>0]);
    }
}
