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
    Route::get('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'edit'])->name('Department.edit');
    Route::post('/Edit-Department/{department}',[\App\Http\Controllers\DepartmentController::class,'update'])->name('Department.update');
    Route::post('/ActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'Active'])->name('Department.Active');
    Route::post('/DisActiveDepartment/{department}',[\App\Http\Controllers\DepartmentController::class,'DisActive'])->name('Department.DisActive');

});


require __DIR__.'/auth.php';
