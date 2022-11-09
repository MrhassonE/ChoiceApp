<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\AllVisit;
use App\Models\Company;
use App\Models\DailyVisit;
use App\Models\Department;
use App\Models\MonthlyVisit;
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
        $advisit = DailyVisit::where('phone_type',1)->get()->count();
        $amvisit = MonthlyVisit::where('phone_type',1)->get()->count();
        $aavisit = AllVisit::where('phone_type',1)->get()->count();

        $idvisit = DailyVisit::where('phone_type',2)->get()->count();
        $imvisit = MonthlyVisit::where('phone_type',2)->get()->count();
        $iavisit = AllVisit::where('phone_type',2)->get()->count();


        return view('Dashboard.dashboard',compact(
            'departments','departmentsMain','companies','companiesNew','companiesMostViewed','ads',
                    'advisit','amvisit','aavisit','idvisit','imvisit','iavisit'
        ));
    }
}
