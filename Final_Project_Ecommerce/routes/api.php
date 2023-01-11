<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::apiresource('category', CategoryController::class);
Route::apiresource('product', ProductController::class);
Route::apiresource('order', OrderController::class);


Route::post('/register',[UserController::class,'register'])->name('register.api');
Route::post('/login',[UserController::class,'login'])->name('login.api');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout',[UserController::class,'logout'])->name('logout.api');
});





