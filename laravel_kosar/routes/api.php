<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
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

Route::post('register',[RegisteredUserController::class, 'store']);
Route::post('login',[AuthenticatedSessionController::class, 'store']);
Route::get('/product-with-user',[ProductController::class, "ProductWithUser"]);
Route::get('/product-user-data',[ProductController::class, "productUserdata"]);


Route::middleware(['auth:sanctum'])->
    group(function(){
        Route::get('/user/{id}',function (Request $request){
            return $request->user();});
            Route::post('logout',[AuthenticatedSessionController::class, 'destroy']);
        });

Route::middleware(['auth:sanctum', Admin::class])->
    group(function(){
        Route::get('/admin/user',[UserController::class,'index']);
        });
        
