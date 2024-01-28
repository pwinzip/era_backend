<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // Add New Assessment
    public function addassessment(Request $request)
    {
        $fields = $request->validate([
            "elder" => 'required|integer',
            "volunteer" => 'required|integer',
            "month" => 'required|integer',
            "year" => 'required|integer'
        ]);

        $assessment = Assessment::create([
            "elder_id" => $fields['elder'],
            "volunteer_id" => $fields['volunteer'],
            "month" => $fields['month'],
            "year" => $fields['year'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response([
            "message" => "New Assessment Added.",
            "data" => $assessment,
        ], 201);
    }
}
