<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Assessment;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    // Get Assessment
    public function getassessmentelder(Request $request, $elderid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $year = date('Y', strtotime(Carbon::now())) + 543;
            $month = intval(date('m', strtotime(Carbon::now())));
            $ass = Assessment::where('elder_id', '=', $elderid)
                ->where('year', '=', $year)
                ->where('month', '=', $month)
                ->get();
            $response = [
                "data" => $ass->first()
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    // Update Final Status
    public function updatestatus(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $result = Assessment::where('ass_id', '=', $assid)
                ->update(['status' => 1, 'updated_at' => Carbon::now()]);
            $response = ['message' => 'Status Updated'];
            return response($response, 204);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }
}
