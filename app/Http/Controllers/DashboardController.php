<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\AllVisit;
use App\Models\Company;
use App\Models\Department;

class DashboardController extends Controller
{
    public function index(){
        $departments = Department::all()->count();
        $departmentsMain = Department::where('is_active',1)->where('is_main',1)->count();
        $companies = Company::all()->count();
        $companiesMostViewed = Company::where('is_active',1)->where('is_main',1)->count();
        $companiesNew = Company::where('is_active',1)->where('new',1)->count();
        $ads = Advertisement::all()->count();
        $month = date('m');
        $day = date('d');
        $advisit = AllVisit::where('phone_type',1)->whereMonth('created_at','=',$month)->whereDay('created_at','=',$day)->count();
        $amvisit = AllVisit::where('phone_type',1)->whereMonth('created_at','=',$month)->count();
        $aavisit = AllVisit::where('phone_type',1)->count();

        $idvisit = AllVisit::where('phone_type',2)->whereMonth('created_at','=',$month)->whereDay('created_at','=',$day)->count();
        $imvisit = AllVisit::where('phone_type',2)->whereMonth('created_at','=',$month)->count();
        $iavisit = AllVisit::where('phone_type',2)->count();

        $avisitEveryMonth = $this->AvisitEveryMonth();
        $ivisitEveryMonth = $this->IvisitEveryMonth();

        return view('Dashboard.dashboard',compact(
            'departments','departmentsMain','companies','companiesNew','companiesMostViewed','ads',
                    'advisit','amvisit','aavisit','idvisit','imvisit','iavisit',
                    'avisitEveryMonth','ivisitEveryMonth'
        ));
    }

    public function AvisitEveryMonth() {
        $year = date('Y');
        $collect = collect();
        for ($i = 1;$i<13;$i++) {
            $month = $i;
            $projects = AllVisit::where('phone_type',1)->whereYear('created_at','=',$year)
                ->whereMonth('created_at','=',$month)->count();
            $collect->push($projects);
        }
        return $collect;
    }

    public function IvisitEveryMonth() {
        $year = date('Y');
        $collect = collect();
        for ($i = 1;$i<13;$i++) {
            $month = $i;
            $projects = AllVisit::where('phone_type',2)->whereYear('created_at','=',$year)
                ->whereMonth('created_at','=',$month)->count();
            $collect->push($projects);
        }
        return $collect;
    }
}
