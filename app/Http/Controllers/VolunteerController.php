<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Elder;
use App\Models\Volunteer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VolunteerController extends Controller
{
    /**
     * Display All Volunteers for Admin
     */
    public function allvolunteerlist(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $volunteers = Volunteer::join('users', 'users.id', '=', 'volunteers.user_id')->get();
            return response([
                "data" => $volunteers,
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Display All Volunteers by specific Address(Tumbon, Moo)
     */
    public function showvolunteerlistbyaddress(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $fields = $request->validate([
                "moo" => 'required|integer',
                "tumbon" => 'required|string',
            ]);
            $volunteers = Volunteer::where('tumbon', '=', $fields["tumbon"])
                ->where('moo', '=', $fields['moo'])->get();
            return response([
                "data" => $volunteers,
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Update Volunteer Personal Info for Admin, Volunteer
     */
    public function updatevolunteer(Request $request, $id)
    {
    }
}
