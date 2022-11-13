<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class LaratrustController extends Controller
{
    public function index(){
        $roles = Role::all();
        return view('Dashboard.Laratrust.index',compact('roles'));
    }
}
