<?php

use App\Http\Controllers\OngkirController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('provinces',[OngkirController::class,'getPorvinces']);
Route::get('province',[OngkirController::class,'searchProvince']);
Route::get('cities',[OngkirController::class,'getCities']);