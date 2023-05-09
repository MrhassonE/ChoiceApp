<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('apiToken')->group(function () {
    // your routes
    Route::get('cities',[\App\Http\Controllers\APIController::class,'getCities'])->name("Cities");
    Route::get('blogCompany/{coId}',[\App\Http\Controllers\APIController::class,'getBlogsbyCompany'])->name("BlogCompany");
    Route::get('blog/{Id}',[\App\Http\Controllers\APIController::class,'getBlogsbyId'])->name("Blog");
    Route::get('review/{Id}',[\App\Http\Controllers\APIController::class,'getReviewbyCompany'])->name("Review");
    Route::get('department/{cId}/{id}',[\App\Http\Controllers\APIController::class,'getDepartmentCityById'])->name("DepartmentByCityId");
    Route::get('departments/{cId}/{id}',[\App\Http\Controllers\APIController::class,'getDepartments'])->name("Departments");
    Route::get('settings',[\App\Http\Controllers\APIController::class,'getSettings'])->name("Settings");
    Route::get('userProfile',[\App\Http\Controllers\APIController::class,'userProfile'])->name("userProfile");
    Route::get('companies/{cId}',[\App\Http\Controllers\APIController::class,'getCompanies'])->name("Companies");
    Route::get('company/{cId}/{id}',[\App\Http\Controllers\APIController::class,'getCompaniesCityById'])->name("CompanyByCityId");
    Route::get('department/company/{dep}',[\App\Http\Controllers\APIController::class,'getCompaniesCityByDep'])->name("CompanyByDepId");
    Route::get('advertisements/{cId}/{id}',[\App\Http\Controllers\APIController::class,'getAdvertisements'])->name("Advertisements");
    Route::get('home/{cId}/{id}',[\App\Http\Controllers\APIController::class,'home'])->name("home");
    Route::get('dephome/{cId}/{id}',[\App\Http\Controllers\APIController::class,'Dephome'])->name("home");
    Route::get('search/{cId}/{id}',[\App\Http\Controllers\APIController::class,'search'])->name("search");
    Route::get('searchByName/{cId}',[\App\Http\Controllers\APIController::class,'searchByName'])->name("search");
    Route::get('getAllReview/{companyId}',[\App\Http\Controllers\APIController::class,'getAllReview'])->name("search");
    Route::post('send',[\App\Http\Controllers\APIController::class,'send'])->name("send");
    Route::post('fcmToken',[\App\Http\Controllers\APIController::class,'fcmToken'])->name("fcmToken");
    Route::post('visit',[\App\Http\Controllers\APIController::class,'visit'])->name("visit");
    Route::post('/login',[\App\Http\Controllers\Api\Auth\LoginController::class,'Login'])->name("login");
    Route::post('/logout',[\App\Http\Controllers\Api\Auth\LoginController::class,'logout'])->name("logout");
    Route::post('/register',[\App\Http\Controllers\Api\Auth\RegisterController::class,'store'])->name("register");
    Route::post('/image',[\App\Http\Controllers\APIController::class,'uploadprofileimage'])->name("image");
    Route::post('/addblog',[\App\Http\Controllers\APIController::class,'addBlog'])->name("addblog");
    Route::post('/addreview',[\App\Http\Controllers\APIController::class,'addReview'])->name("addreview");
    Route::post('/RequestMeet',[\App\Http\Controllers\APIController::class,'RequestMeet'])->name("RequestMeet");
});
