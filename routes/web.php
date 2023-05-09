<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 
Route::get('/dashboard', function () {
    return view('welcome');
});

Route::get('register-form', [Auth\RegistrationController::class, 'show'])->name('register.form')->middleware('guest');
Route::post('store', [Auth\RegistrationController::class, 'Register'])->name('register.store');
Route::get('login-form', [Auth\LoginController::class, 'show'])->name('login')->middleware('guest');;
Route::post('submit-login', [Auth\LoginController::class, 'submitLogin'])->name('login.submit');

Route::get('/home',[Auth\LoginController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::get('logOut', [Auth\LoginController::class, 'logOut'])->name('logOut');
