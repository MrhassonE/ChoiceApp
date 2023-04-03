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
    Route::get('/lara', [\App\Http\Controllers\LaratrustController::class,'index'])->name('Lara');

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

// Setting
    Route::get('/setting',[\App\Http\Controllers\GeneralSettingController::class,'index'])->name('Setting');
    Route::get('/policy',[\App\Http\Controllers\GeneralSettingController::class,'policyConditionsPage'])->name('Setting.policy');
    Route::get('/activityLog',[\App\Http\Controllers\ActivityLogController::class,'ActivityLog'])->name('Setting.activityLog');
    Route::post('/setting/info',[\App\Http\Controllers\GeneralSettingController::class,'SettingInfo'])->name('Setting.info');
    Route::post('/setting/policyConditions/{setting}',[\App\Http\Controllers\GeneralSettingController::class,'policyConditions'])->name('Setting.policyConditions');
    Route::post('/setting',[\App\Http\Controllers\GeneralSettingController::class,'update'])->name('Setting.update');
    Route::post('/setting/email',[\App\Http\Controllers\GeneralSettingController::class,'storeEmail'])->name('Setting.email');
    Route::post('/setting/appUrl',[\App\Http\Controllers\GeneralSettingController::class,'appUrl'])->name('Setting.appUrl');
    Route::post('/setting/contact',[\App\Http\Controllers\GeneralSettingController::class,'updateContact'])->name('Setting.contact');


// Country
    Route::get('/country',[\App\Http\Controllers\CountryController::class,'index'])->name('Country');
    Route::post('/country',[\App\Http\Controllers\CountryController::class,'store'])->name('Country.store');
    Route::get('/Edit-Country/{country}',[\App\Http\Controllers\CountryController::class,'edit'])->name('Country.edit');
    Route::post('/Edit-Country/{country}',[\App\Http\Controllers\CountryController::class,'update'])->name('Country.update');
    Route::post('/ActiveCountry/{country}',[\App\Http\Controllers\CountryController::class,'Active'])->name('Country.Active');
    Route::post('/DisActiveCountry/{country}',[\App\Http\Controllers\CountryController::class,'DisActive'])->name('Country.DisActive');

// City

    Route::get('/city',[\App\Http\Controllers\CityController::class,'index'])->name('City');
    Route::post('/city',[\App\Http\Controllers\CityController::class,'store'])->name('City.store');
    Route::get('/Edit-City/{city}',[\App\Http\Controllers\CityController::class,'edit'])->name('City.edit');
    Route::post('/Edit-City/{city}',[\App\Http\Controllers\CityController::class,'update'])->name('City.update');
    Route::post('/ActiveCity/{city}',[\App\Http\Controllers\CityController::class,'Active'])->name('City.Active');
    Route::post('/DisActiveCity/{city}',[\App\Http\Controllers\CityController::class,'DisActive'])->name('City.DisActive');

// WhatsNew
    Route::get('/news',[\App\Http\Controllers\WhatsNewController::class,'index'])->name('WhatsNew');
    Route::post('/news',[\App\Http\Controllers\WhatsNewController::class,'store'])->name('WhatsNew.store');
    Route::get('/Edit-WhatsNew/{new}',[\App\Http\Controllers\WhatsNewController::class,'edit'])->name('WhatsNew.edit');
    Route::post('/Edit-WhatsNew/{new}',[\App\Http\Controllers\WhatsNewController::class,'update'])->name('WhatsNew.update');
    Route::post('/Delete-WhatsNew/{new}',[\App\Http\Controllers\WhatsNewController::class,'destroy'])->name('WhatsNew.delete');

// Department
    Route::get('/department',[\App\Http\Controllers\DepartmentController::class,'index'])->name('Department');
    Route::post('/department',[\App\Http\Controllers\DepartmentController::class,'store'])->name('Department.store');
    Route::get('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'edit'])->name('Department.edit');
    Route::get('/Show-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'show'])->name('Department.show');
    Route::post('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'update'])->name('Department.update');
    Route::post('/ActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'Active'])->name('Department.Active');
    Route::post('/DisActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'DisActive'])->name('Department.DisActive');
    Route::post('/DeleteDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'destroy'])->name('Department.Delete');
    Route::post('/MainSection-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'mainSection'])->name('Department.mainSection');

// SubDepartment
    Route::get('/subDepartment/{department}',[\App\Http\Controllers\SubDepartmentController::class,'index'])->name('SubDepartment');
    Route::post('/subDepartment/{department}',[\App\Http\Controllers\SubDepartmentController::class,'store'])->name('SubDepartment.store');
    Route::get('/Edit-SubDepartment/{subDepartment}',[\App\Http\Controllers\SubDepartmentController::class,'edit'])->name('SubDepartment.edit');
    Route::post('/Edit-SubDepartment/{subDepartment}',[\App\Http\Controllers\SubDepartmentController::class,'update'])->name('SubDepartment.update');
    Route::post('/ActiveSubDepartment/{subDepartment}',[\App\Http\Controllers\SubDepartmentController::class,'Active'])->name('SubDepartment.Active');
    Route::post('/DisActiveSubDepartment/{subDepartment}',[\App\Http\Controllers\SubDepartmentController::class,'DisActive'])->name('SubDepartment.DisActive');
    Route::post('/DeleteSubDepartment/{subDepartment}',[\App\Http\Controllers\SubDepartmentController::class,'destroy'])->name('SubDepartment.Delete');


// Company
    Route::get('/coCountiesSuper/{country}',[\App\Http\Controllers\CompanyController::class,'coCountiesSuper']);
    Route::get('/coCitiesSuper/{country}',[\App\Http\Controllers\CompanyController::class,'coCitiesSuper']);
    Route::get('/coDepsSuper/{city}',[\App\Http\Controllers\CompanyController::class,'coDepsSuper']);
    Route::get('/cosFromCitySuper/{city}',[\App\Http\Controllers\AdvertisementController::class,'cosFromCitySuper']);


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

// Notification
    Route::get('/notifications',[\App\Http\Controllers\CustomNotificationController::class,'index'])->name('CustomNotification');
    Route::post('/notifications',[\App\Http\Controllers\CustomNotificationController::class,'store'])->name('CustomNotification.store');

    Route::post('/fcmToken',function (\Illuminate\Http\Request $request) {
       return $request->all();
    })->name('fcmToken');
});


require __DIR__.'/auth.php';
