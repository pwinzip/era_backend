<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\RiskAssessment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    // Get Risk Assessment Result (assid)
    function getresultpart($assid, $part)
    {
        return RiskAssessment::where('ass_id', '=', $assid)
            ->where('part', '=', $part)
            ->get();
    }

    function calresultpart($arrpart)
    {
        $sum = 0;
        foreach ($arrpart as $part) {
            $count = 0;
            $mul = $part['touch'] * $part['violent'];

            foreach ($part['manage'] as $manage) {
                if ($manage) $count++;
            }
            $partresult = $mul - $count;
            if ($partresult < 0) $partresult = 0;
            $sum += $partresult;
        }
        return $sum;
    }
    public function getriskresult(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $result = [0, 0, 0, 0, 0, 0, 0, 0];
            $index = 0;

            for ($i = 1; $i <= count($result); $i++) {
                $respart = $this->getresultpart($assid, $i);
                $result[$index++] = $this->calresultpart($respart) / $respart->count();
            }

            $sum = 0;
            foreach ($result as $res) {
                $sum += $res;
            }
            $overall = $sum / count($result);

            $response = [
                "resultpart" => $result,
                "overall" => $overall
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    // Get Risk Assessment(ass_id)
    public function getriskassessment(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartone(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 1)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskparttwo(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 2)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartthree(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 3)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartfour(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 4)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartfive(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 5)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartsix(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 6)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskpartseven(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 7)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function getriskparteight(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $risk = RiskAssessment::where('ass_id', '=', $assid)
                ->where('part', '=', 8)
                ->get();
            $response = [
                "data" => $risk,
            ];
            return response($response, 200);
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

    // Check AssID exists in RiskAssessment
    function checkriskexist($assid, $part)
    {
        // Check RiskAssessment exists
        $risk = RiskAssessment::where('ass_id', '=', $assid)
            ->where('part', '=', $part)
            ->get();
        return $risk;
    }


    // Add New Risk Assessment(assid)
    public function addriskassessment(Request $request, $assid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $fields = $request->validate([
                "part" => "required|integer",
                "result" => "required|array",
            ]);

            $part = $fields['part'];
            $isRiskExist = $this->checkriskexist($assid, $part);

            if ($isRiskExist->count() == 0) {
                $ass_part = "ass_part" . $part;
                Assessment::where('ass_id', '=', $assid)
                    ->update([$ass_part => 1, 'updated_at' => Carbon::now()]);

                foreach ($fields['result'] as $re) {
                    $newrisk = RiskAssessment::create([
                        "ass_id" => $assid,
                        "part" => $part,
                        "subpart" => $re["subpart"],
                        "touch" => $re["touch"],
                        "violent" => $re["violent"],
                        "manage" => $re["manage"],
                        "created_at" => Carbon::now(),
                        "updated_at" => Carbon::now(),
                    ]);
                }

                $response = [
                    "message" => "New Risk Assessment Added.",
                ];
                return response($response, 201);
            } else {
                $ass_part = "ass_part" . $part;
                Assessment::where('ass_id', '=', $assid)
                    ->update([$ass_part => 1, 'updated_at' => Carbon::now()]);

                foreach ($fields['result'] as $re) {
                    $newrisk = RiskAssessment::where('ass_id', '=', $assid)
                        ->where('part', '=', $part)
                        ->where('subpart', '=', $re['subpart'])
                        ->update([
                            "touch" => $re["touch"],
                            "violent" => $re["violent"],
                            "manage" => $re["manage"],
                            "updated_at" => Carbon::now(),
                        ]);
                }
                $response = [
                    "message" => "Risk Assessment Updated.",
                ];
                return response($response, 204);
            }
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }
}
