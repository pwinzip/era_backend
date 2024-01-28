<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalAssessment;

class PersonalAssessmentController extends Controller
{
    // Show Personal Assessment(Ass_id)
    public function getpersonalassessment(Request $request, $assid)
    {
        $pa = PersonalAssessment::where('ass_id', '=', $assid)->get();
        return response([
            "data" => $pa,
        ]);
    }
    // Add New Personal Assessment
    public function addpersonalassessment(Request $request)
    {
        $fields = $request->validate([
            "ass_id" => 'required|integer',
            "age" => 'required|integer',
            "weight" => 'required|double',
            "height" => 'required|double',
            "career" => 'required|string',
            "income" => 'required|double',
            "education" => 'required|integer',
            "marital" => 'required|integer',
            "member" => 'required|integer',
            "children" => 'required|integer',
            "year_working" => 'required|integer',
            "period_working" => 'required|integer',
        ]);

        $assessment = PersonalAssessment::create([
            "ass_id" => $fields['ass_id'],
            "age" => $fields['age'],
            "weight" => $fields['weight'],
            "height" => $fields['height'],
            "career" => json_encode($fields['career']),
            "income" => $fields['income'],
            "high_education" => $fields['education'],
            "marital_status" => $fields['marital'],
            "house_member" => $fields['member'],
            "children" => $fields['children'],
            "year_working" => $fields['year_working'],
            "period_working" => $fields['period_working'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response([
            "message" => "New Personal Assessment Added.",
            "data" => $assessment,
        ], 201);
    }

    // Modify Personal Assessment(Ass_id)
    public function modifypersonassessment(Request $request)
    {
        $fields = $request->validate([
            "ass_id" => 'required|integer',
            "age" => 'required|integer',
            "weight" => 'required|double',
            "height" => 'required|double',
            "career" => 'required|string',
            "income" => 'required|double',
            "education" => 'required|integer',
            "marital" => 'required|integer',
            "member" => 'required|integer',
            "children" => 'required|integer',
            "year_working" => 'required|integer',
            "period_working" => 'required|integer',
        ]);

        $assessment = PersonalAssessment::where('ass_id', '=', $fields['ass_id'])
            ->update([
                "age" => $fields['age'],
                "weight" => $fields['weight'],
                "height" => $fields['height'],
                "career" => json_encode($fields['career']),
                "income" => $fields['income'],
                "high_education" => $fields['education'],
                "marital_status" => $fields['marital'],
                "house_member" => $fields['member'],
                "children" => $fields['children'],
                "year_working" => $fields['year_working'],
                "period_working" => $fields['period_working'],
                'updated_at' => Carbon::now(),
            ]);
        return response([
            "message" => "Personal Assessment Updated.",
            "data" => $assessment,
        ], 200);
    }
}
