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
        $departmentsMain = Department::where('is_active',1)->where('is_main',1)->count();
        $companies = Company::all()->count();
        $companiesMostViewed = Company::where('is_active',1)->where('is_main',1)->count();
        $companiesNew = Company::where('is_active',1)->where('new',1)->count();
        $ads = Advertisement::all()->count();
        return view('Dashboard.dashboard',compact('departments','departmentsMain','companies','companiesNew','companiesMostViewed','ads'));
    }
}
