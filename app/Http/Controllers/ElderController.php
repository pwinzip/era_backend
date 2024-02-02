<?php

namespace App\Http\Controllers;

use App\Models\Elder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElderController extends Controller
{
    /**
     * Display All Elder for Admin
     */
    public function allelderlist(Request $request)
    {
        if ($request->user->tokenCan("0") || $request->user->tokenCan("1")) {
            $elders = Elder::all();
            return response([
                "data" => $elders,
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Display All Elder by specific Address(Tumbon, Moo)
     */
    public function showelderbyaddress(Request $request)
    {
        if ($request->user->tokenCan("0") || $request->user->tokenCan("1")) {
            $fields = $request->validate([
                "moo" => 'required|interger',
                "tumbon" => 'required|string',
            ]);
            $elders = Elder::where("tambon", $fields["tumbon"])
                ->where("moo", "=", $fields["moo"])
                ->get();
            return response([
                "message" => $elders,
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Display All Elder by specific Volunteer(id)
     */
    public function showelderbyvolunteer(Request $request, $volid)
    {
        // if ($request->user->tokenCan("1")) {
        // $elders = DB::table('elders')
        //     ->join('users as u1', 'u1.id', '=', 'elders.user_id')
        //     ->join('users as u2', 'u2.id', '=', 'elders.volunteer_id')
        //     ->where('volunteer_id', '=', $fields['volunteer'])
        //     ->select('elders.*', 'u1.prefix', 'u1.name as n1', 'u2.name as n2')
        //     ->get();
        $year = date('Y', strtotime(Carbon::now())) + 543;
        $month = intval(date('m', strtotime(Carbon::now())));

        $elders = DB::table('assessments')
            ->join('users', 'users.id', '=', 'assessments.elder_id')
            ->join('elders', 'elders.user_id', 'assessments.elder_id')
            ->where('assessments.volunteer_id', '=', $volid)
            ->where('assessments.year', '=', $year)
            ->where('assessments.month', '=', $month)
            ->select('assessments.elder_id', 'users.prefix', 'users.name', 'elders.moo', 'elders.tambon', 'elders.amphoe', 'assessments.month', 'assessments.year', 'assessments.status')
            ->orderBy('status')
            ->orderBy('assessments.elder_id')
            ->get();

        return response([
            "data" => $elders,
            'year' => $year,
            'month' => $month,
        ], 200);
        // } else {
        //     return response([
        //         "message" => "Permission Denied.",
        //     ], 403);
        // }
    }

    /**
     * Update Elder Personal Info for Admin, Volunteer
     */
    public function updateelder(Request $request, $id)
    {
    }

    /**
     * Toggle Permission of Elder Status for Admin
     */
    public function toggleelder(Request $request, $id)
    {
    }


    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Elder $elder)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Elder $elder)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Elder $elder)
    // {
    //     //
    // }
}
