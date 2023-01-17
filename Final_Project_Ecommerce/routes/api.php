<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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




Route::post('/register', [UserController::class, 'register'])->name('register.api');
Route::post('/login', [UserController::class, 'login'])->name('login.api');

Route::middleware('auth:api')->group(function () {
    Route::post('email/verify', [UserController::class, 'verifyEmail']);
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [UserController::class, 'logout'])->name('logout.api');
});
Route::post('password/forget', [ForgotPasswordController::class, 'forgot'])->name('password.forget.api');
Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.reset.api');

Route::middleware('auth:api')->group(function () {
    Route::post('/update', [UpdatePasswordController::class, 'update'])->name('update.api');
});

Route::middleware('auth:api')->group(function () {

    /*Admin middleware is call in the resource constructor &
     'verify.api' middleware is to check that user email is verified or not.*/

    Route::apiresource('category', CategoryController::class)->middleware('verify.api');
    Route::apiresource('product', ProductController::class)->middleware('verify.api');

    //For order admin middleware is not applicable because it is mentained by user.
    Route::apiresource('order', OrderController::class)->middleware('verify.api');
});