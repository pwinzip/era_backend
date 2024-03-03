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

// Route::get('elderlist/{volid}', [ElderController::class, 'showelderbyvolunteer']);

// Route::post('volunteers', [VolunteerController::class, 'addvolunteer']);
// Route::get('volunteerbyaddress', [VolunteerController::class, 'showvolunteerbyaddress']);

// Protected Route
Route::group(["middleware" => "auth:sanctum"], function () {
    Route::post('admins', [AuthController::class, 'registerAdmin']);
    Route::post('volunteers', [AuthController::class, 'registerVolunteer']);
    Route::post('elders', [AuthController::class, 'registerElder']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('admins', [AuthController::class, 'alladminlist']);

    // Elder
    Route::get('elders', [ElderController::class, 'allelderlist']);
    Route::get('eldersbyadmin', [ElderController::class, 'showelders']);
    Route::post('eldersbyaddress', [ElderController::class, 'showelderbyaddress']);
    Route::get('elderinfo/{eldid}', [ElderController::class, 'showelderinformation']);

    // Volunteer
    Route::get('volunteers', [VolunteerController::class, 'allvolunteerlist']);

    // Assessment
    Route::get('assessmentelder/{eldid}', [AssessmentController::class, 'getassessmentelder']);
    Route::put('updatestatus/{assid}', [AssessmentController::class, 'updatestatus']);

    // Personal Assessment
    Route::post('addpersonalassessment', [PersonalAssessmentController::class, 'addpersonalassessment']);
    Route::get('personalassessment/{eldid}', [PersonalAssessmentController::class, 'getpersonalassessment']);

    // Risk Assessment
    Route::get('riskassessments/{assid}', [RiskAssessmentController::class, "getriskassessment"]);
    Route::post('addriskassessments/{assid}', [RiskAssessmentController::class, "addriskassessment"]);
    Route::get('riskpartone/{assid}', [RiskAssessmentController::class, "getriskpartone"]);
    Route::get('riskparttwo/{assid}', [RiskAssessmentController::class, "getriskparttwo"]);
    Route::get('riskpartthree/{assid}', [RiskAssessmentController::class, "getriskpartthree"]);
    Route::get('riskpartfour/{assid}', [RiskAssessmentController::class, "getriskpartfour"]);
    Route::get('riskpartfive/{assid}', [RiskAssessmentController::class, "getriskpartfive"]);
    Route::get('riskpartsix/{assid}', [RiskAssessmentController::class, "getriskpartsix"]);
    Route::get('riskpartseven/{assid}', [RiskAssessmentController::class, "getriskpartseven"]);
    Route::get('riskparteight/{assid}', [RiskAssessmentController::class, "getriskparteight"]);
    Route::get('riskresult/{assid}', [RiskAssessmentController::class, "getriskresult"]);
});
