<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function Login(Request $request) {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
//        Validator::make($request->all(),[
//            [
//                'email' => ['required', 'email'],
//                'password' => ['required'],
//            ]
//        ],[
//            'email.required' => 'يجب ادخال البريد الالكتروني',
//            'email.email' => ' البريد الالكتروني غير صالح',
//            'password.required' => 'يجب ادخال الرمز',
//        ]);
        $credentials = $request->only(['email','password']);
        if(!$token = Auth::guard('api')->attempt($credentials)) {
            return response()->json(false);
        }
        $res=Collect(["user" => Auth::guard('api')->user()]);
//        $res=Collect(["user" => Auth::user()]);
        $res=$res->merge(["token" => $token]);
        return $res;
    }
    public function logout(Request $request) {
        $token = $request->header('auth-token');

//        JWTAuth::setToken($token)->invalidate();
//        JWTAuth::invalidate($token);
//        Auth::user()->tokens->each(function($token, $key) {
//            $token->delete();
//        });

        JWTAuth::invalidate($token);
        auth()->logout();
        return response()->json('Successfully logged out');
    }
}
