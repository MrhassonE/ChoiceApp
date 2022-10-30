<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cities',[\App\Http\Controllers\APIController::class,'getCities'])->name("Cities");
Route::get('department/{id}',[\App\Http\Controllers\APIController::class,'getDepartmentCityById'])->name("DepartmentByCityId");
Route::get('departments',[\App\Http\Controllers\APIController::class,'getDepartments'])->name("Departments");
Route::get('settings',[\App\Http\Controllers\APIController::class,'getSettings'])->name("Settings");
Route::get('companies',[\App\Http\Controllers\APIController::class,'getCompanies'])->name("Companies");
Route::get('company/{id}',[\App\Http\Controllers\APIController::class,'getCompaniesCityById'])->name("CompanyByCityId");
Route::get('department/company/{dep}',[\App\Http\Controllers\APIController::class,'getCompaniesCityByDep'])->name("CompanyByDepId");
Route::get('advertisements',[\App\Http\Controllers\APIController::class,'getAdvertisements'])->name("Advertisements");
Route::post('send',[\App\Http\Controllers\APIController::class,'send'])->name("send");
Route::get('home/{id}',[\App\Http\Controllers\APIController::class,'home'])->name("home");
