<?php

use App\Http\Controllers\Auth\AuthController;
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
    return redirect('login');
});

Route::middleware('guest')->controller(AuthController::class)->group(function(){
    Route::get('/login', 'index')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/showRegister', 'showRegister')->name('showRegister');
    Route::post('/register', 'store')->name('register');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::fallback( function(){
//    return abort(405);
// });
