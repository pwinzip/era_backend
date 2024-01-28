<?php

namespace App\Http\Controllers;

use App\Models\RiskAssessment;
use Illuminate\Http\Request;

class RiskAssessmentController extends Controller
{
    // Get Risk Assessment(ass_id)
    public function getriskassessment(Request $request, $assid)
    {
        $ra = RiskAssessment::where('ass_id', '=', $assid)->get();
        $response = [
            "data" => $ra,
        ];
        return response($response, 200);
    }
    // Add New Risk Assessment
    public function addriskassessment(Request $request)
    {
        $fields = $request->validate([
            "assid" => "required|integer",
            "part" => "required|integer",
            "subpart" => "required|string",
            "touch" => "required|integer",
            "violent" => "required|integer",
            "manage" => "required|array",
            "note" => "nullable|string",
        ]);

        $new_ra = RiskAssessment::create(
            [
                "ass_id" => $fields["assid"],
                "part" => $fields['part'],
                'subpart' => $fields['subpart'],
                'touch' => $fields['touch'],
                'violent' => $fields['violent'],
                'manage' => $fields['manage'],
                'note' => $fields['note'],
            ]
        );
        $response = [
            "message" => "New Risk Assessment Added.",
        ];
        return response($response, 200);
    }


    // Modify Risk Assessment(Ass_id, Part)
}
