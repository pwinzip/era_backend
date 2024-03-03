<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\PersonalAssessment;

class PersonalAssessmentController extends Controller
{
    // Show Personal Assessment(Ass_id)
    public function getpersonalassessment(Request $request, $elderid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $assExist = $this->checkassessmentexist($elderid);
            if ($assExist->count() == 0) {
                return response([
                    "data" => []
                ]);
            } else {
                $assid = $assExist->first()['ass_id'];
                $personal = PersonalAssessment::where('ass_id', '=', $assid)->get();
                return response([
                    "data" => $personal
                ]);
            }
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    function checkassessmentexist($elderid)
    {
        // Check Assessment exists
        $year = date('Y', strtotime(Carbon::now())) + 543;
        $month = intval(date('m', strtotime(Carbon::now())));

        $ass = Assessment::where('elder_id', '=', $elderid)
            ->where('month', '=', $month)
            ->where('year', '=', $year)
            ->get();
        return $ass;
    }


    // Add New Personal Assessment
    public function addpersonalassessment(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $fields = $request->validate([
                "elder_id" => 'required|integer',
                "assessor_id" => 'required|integer',
                "gender" => 'required|integer',
                "age" => 'required|integer',
                "weight" => 'required|numeric',
                "height" => 'required|numeric',
                "career" => 'required|array',
                "income" => 'required|numeric',
                "education" => 'required|integer',
                "marital" => 'required|integer',
                "member" => 'required|integer',
                "children" => 'required|integer',
                "year_working" => 'required|integer',
                "period_working" => 'required|integer',
            ]);

            $isAssExist = $this->checkassessmentexist($fields['elder_id']);

            if ($isAssExist->count() == 0) {
                // Add New Assessment and Personal Assessment
                $year = date('Y', strtotime(Carbon::now())) + 543;
                $month = intval(date('m', strtotime(Carbon::now())));
                $assessment = Assessment::create([
                    "elder_id" => $fields['elder_id'],
                    "assessor_id" => $fields['assessor_id'],
                    "month" => $month,
                    "year" => $year,
                    "ass_personal" => 1,
                    "created_at" => Carbon::now(),
                    "updated_at" => Carbon::now(),
                ]);

                $personal = PersonalAssessment::create([
                    "ass_id" => $assessment->id,
                    "age" => $fields['age'],
                    "gender" => $fields['gender'],
                    "weight" => $fields['weight'],
                    "height" => $fields['height'],
                    "career" => $fields['career'],
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
                    "data" => $personal,
                ], 201);
            } else {
                // Update Assessment and Update Personal
                $assessment = Assessment::where('ass_id', '=', $isAssExist->first()['ass_id'])
                    ->update([
                        "ass_personal" => 1,
                        'updated_at' => Carbon::now(),
                    ]);
                $personal = PersonalAssessment::where('ass_id', '=', $isAssExist->first()['ass_id'])
                    ->update([
                        "age" => $fields['age'],
                        "weight" => $fields['weight'],
                        "height" => $fields['height'],
                        "career" => $fields['career'],
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
                    "data" => $personal,
                ], 204);
            }
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }
}
