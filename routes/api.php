<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElderController;
use App\Http\Controllers\PersonalAssessmentController;
use App\Http\Controllers\RiskAssessmentController;
use App\Http\Controllers\VolunteerController;
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

Route::get('riskassessments/{assid}', [RiskAssessmentController::class, "getriskassessment"]);
Route::post('newriskassessments', [RiskAssessmentController::class, "addriskassessment"]);


// Protected Route
Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('addadmin', [AuthController::class, 'registerAdmin']);
    Route::post('addvolunteer', [AuthController::class, 'registerVolunteer']);
    Route::post('addelder', [AuthController::class, 'registerElder']);
    Route::post('logout', [AuthController::class, 'logout']);

    // Elder
    Route::get('elders', [ElderController::class, 'allelderlist']);
    Route::get('elderlist/{volid}', [ElderController::class, 'showelderbyvolunteer']);
    Route::get('showelders', [ElderController::class, 'showelderbyaddress']);

    // Volunteer
    Route::get('volunteers', [VolunteerController::class, 'allvolunteerlist']);
    Route::get('volunteerlist', [VolunteerController::class, 'showvolunteerbyaddress']);

    // Assessment
    Route::post('newassessment', [AssessmentController::class, 'addassessment']);

    // Personal Assessment
    Route::get('personalassessment/{assid}', [PersonalAssessmentController::class, 'getpersonalassessment']);
    Route::post('addpersonalassessment', [PersonalAssessmentController::class, 'addpersonalassessment']);
    Route::post('modifypersonassessment', [PersonalAssessmentController::class, 'modifypersonassessment']);

    // Risk Assessment
});
