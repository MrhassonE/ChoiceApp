<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::middleware('auth')->group(function (){

// Dashboard
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class,'index'])->name('Dashboard');

// Staff
    Route::get('/Staff',[\App\Http\Controllers\StaffController::class,'index'])->name('Staff');
    Route::get('/Profile',[\App\Http\Controllers\StaffController::class,'profile'])->name('Profile');
    Route::get('/Edit-Staff/{user}',[\App\Http\Controllers\StaffController::class,'edit'])->name('Staff.edit');
    Route::post('/Edit-Staff/{user}',[\App\Http\Controllers\StaffController::class,'update'])->name('Staff.update');
    Route::post('/Staff',[\App\Http\Controllers\StaffController::class,'store'])->name('Staff.store');
    Route::post('/Staff-ChangePassword/{user}',[\App\Http\Controllers\StaffController::class,'ChangePassword'])->name('Staff.ChangePassword');
    Route::post('/DeleteUser/{user}',[\App\Http\Controllers\StaffController::class,'delete'])->name('Staff.delete');
    Route::post('/ActiveUser/{user}',[\App\Http\Controllers\StaffController::class,'Active'])->name('Staff.Active');
    Route::post('/DisActiveUser/{user}',[\App\Http\Controllers\StaffController::class,'DisActive'])->name('Staff.DisActive');

// General Setting
    Route::get('/activityLog',[\App\Http\Controllers\ActivityLogController::class,'ActivityLog'])->name('Setting.activityLog');

// City
    Route::get('/city',[\App\Http\Controllers\CityController::class,'index'])->name('City');
    Route::post('/city',[\App\Http\Controllers\CityController::class,'store'])->name('City.store');
    Route::get('/Edit-City/{city}',[\App\Http\Controllers\CityController::class,'edit'])->name('City.edit');
    Route::post('/Edit-City/{city}',[\App\Http\Controllers\CityController::class,'update'])->name('City.update');
    Route::post('/ActiveCity/{city}',[\App\Http\Controllers\CityController::class,'Active'])->name('City.Active');
    Route::post('/DisActiveCity/{city}',[\App\Http\Controllers\CityController::class,'DisActive'])->name('City.DisActive');

// Department
    Route::get('/department',[\App\Http\Controllers\DepartmentController::class,'index'])->name('Department');
    Route::post('/department',[\App\Http\Controllers\DepartmentController::class,'store'])->name('Department.store');
    Route::post('/department/storeCompany/{department}',[\App\Http\Controllers\DepartmentController::class,'storeCompany'])->name('Department.storeCompany');
    Route::get('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'edit'])->name('Department.edit');
    Route::get('/Show-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'show'])->name('Department.show');
    Route::post('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'update'])->name('Department.update');
    Route::post('/ActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'Active'])->name('Department.Active');
    Route::post('/DisActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'DisActive'])->name('Department.DisActive');
    Route::post('/DeleteDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'destroy'])->name('Department.Delete');
    Route::post('/MainSection-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'mainSection'])->name('Department.mainSection');


// Company
    Route::get('/company',[\App\Http\Controllers\CompanyController::class,'index'])->name('Company');
    Route::post('/company',[\App\Http\Controllers\CompanyController::class,'store'])->name('Company.store');
    Route::get('/Edit-Company/{company}',[\App\Http\Controllers\CompanyController::class,'edit'])->name('Company.edit');
    Route::get('/Show-Company/{company}',[\App\Http\Controllers\CompanyController::class,'show'])->name('Company.show');
    Route::post('/Edit-Company/{company}',[\App\Http\Controllers\CompanyController::class,'update'])->name('Company.update');
    Route::post('/Edit-CompanyEvaluation/{company}',[\App\Http\Controllers\CompanyController::class,'CompanyEvaluation'])->name('Company.CompanyEvaluation');
    Route::post('/storeImage-Company/{company}',[\App\Http\Controllers\CompanyController::class,'storeImage'])->name('Company.storeImage');
    Route::post('/deleteImage-Company/{image}',[\App\Http\Controllers\CompanyController::class,'deleteImage'])->name('Company.StoreImage');
    Route::post('/ActiveCompany/{company}',[\App\Http\Controllers\CompanyController::class,'Active'])->name('Company.Active');
    Route::post('/DisActiveCompany/{company}',[\App\Http\Controllers\CompanyController::class,'DisActive'])->name('Company.DisActive');
    Route::post('/DeleteCompany/{company}',[\App\Http\Controllers\CompanyController::class,'destroy'])->name('Company.Delete');

    Route::post('/MostViewedSection-Company/{company}',[\App\Http\Controllers\CompanyController::class,'MostViewedSection'])->name('Company.MostViewedSection');
    Route::post('/NewSection-Company/{company}',[\App\Http\Controllers\CompanyController::class,'NewSection'])->name('Company.NewSection');
    Route::post('/MainSection-Company/{company}',[\App\Http\Controllers\CompanyController::class,'mainSection'])->name('Company.mainSection');

// Advertisement
    Route::get('/advertisement',[\App\Http\Controllers\AdvertisementController::class,'index'])->name('Advertisement');
    Route::post('/advertisement',[\App\Http\Controllers\AdvertisementController::class,'store'])->name('Advertisement.store');
    Route::get('/Edit-Advertisement/{advertisement}',[\App\Http\Controllers\AdvertisementController::class,'edit'])->name('Advertisement.edit');
    Route::post('/Edit-Advertisement/{advertisement}',[\App\Http\Controllers\AdvertisementController::class,'update'])->name('Advertisement.update');
    Route::post('/DeleteAdvertisement/{advertisement}',[\App\Http\Controllers\AdvertisementController::class,'destroy'])->name('Advertisement.Delete');

});


require __DIR__.'/auth.php';
