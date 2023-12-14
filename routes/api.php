<?php

use App\Http\Controllers\AuthController;
use App\Models\Elder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public Route
Route::post('login', [AuthController::class, 'login']);

// Protected Route
Route::group(["middleware" => "auth:sanctum"], function(){
    Route::post('addadmin', [AuthController::class, 'registerAdmin']);
    Route::post('addvolunteer', [AuthController::class, 'registerVolunteer']);
    Route::post('addelder', [AuthController::class, 'registerElder']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Elder
    Route::post('showelder', [Elder::class, 'showelderbyaddress']);
});
