<?php

use App\Http\Controllers\ForgotPasswordController;
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
});
//Route::view('forgot_password', 'ForgotPasswordForm')->name('password.reset');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'forgotPasswordForm'])->name('reset.password.get');
//Route::post('password/reset', [ForgotPasswordController::class, 'reset'])->name('password.reset.api');
