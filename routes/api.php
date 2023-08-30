<?php

use App\Http\Controllers\Auth\AuthController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//login to hava an API TOKEN (but first need an SECRET TOKEN)
Route::controller(AuthController::class)->group(function(){
    Route::post('/loginApi', 'authenticate')->middleware(['check.api']);
    Route::middleware('auth:api')->group(function(){
        Route::post('/logoutApi', 'logout');
        Route::get('/showAllUsers', 'dashboard');
    });
  
});
