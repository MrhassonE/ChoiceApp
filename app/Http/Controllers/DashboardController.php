<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $departments = Department::all()->count();
        $companies = Company::all()->count();
        $ads = Advertisement::all()->count();
        return view('Dashboard.dashboard',compact('departments','companies','ads'));
    }
}
