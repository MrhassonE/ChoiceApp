<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    public function store(Request $request) {
        $request->validate(
            [
                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
                'password' => ['required'],
                'username' => ['required','string',  'max:191', 'unique:users'],
                'phone' => ['required', 'string', 'max:100', 'unique:users'],
            ]);
//        $validate = Validator::make($request->all(),[
//            [
//                'name' => 'required|max:191|string',
//                'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
//                'password' => ['required', 'confirmed', Rules\Password::defaults()],
//                'phone' => ['required', 'string', 'max:100', 'unique:users'],
//            ]
//        ],[
//            'name.required' => 'يجب ادخال الاسم',
//            'name.max' => 'يجب ان لا يتجاوز الاسم 190 حرف',
//            'name.string' => 'يجب ان يكون الاسم نص',
//
//            'email.required' => 'يجب ادخال البريد الالكتروني',
//            'email.max' => 'يجب ان لا يتجاوز البريد الالكتروني 190 حرف',
//            'email.email' => ' البريد الالكتروني غير صالح',
//            'email.unique' => ' البريد الالكتروني مستخدم مسبقا',
//
//            'password.required' => 'يجب ادخال الرمز',
//            'password.confirmed' => 'يجب تأكيد الرمز',
//
//            'phone.required' => 'يجب ادخال رقم الهاتف',
//            'phone.max' => 'يجب ان لا يتجاوز رقم الهاتف 11 رقم',
//            'phone.unique' => 'رقم الهاتف مستخدم مسبقا',
//
//        ]);
//        if($validate->fails()) {
//            return $validate->errors();
//        }

        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'username' => $request->username,
            'is_admin' => 0,
            'is_active' => 1,
            'password' => Hash::make($request->password),
            'confirm_password' => Hash::make($request->password),
        ]);
        if ($user){
            return true;
        }
        event(new Registered($user));

        Auth::guard('api')->login($user);

        return true;
    }
}
