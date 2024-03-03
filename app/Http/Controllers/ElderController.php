<?php

namespace App\Http\Controllers;

use App\Models\Elder;
use Carbon\Carbon;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElderController extends Controller
{
    /**
     * Display All Elder for Admin
     */
    public function allelderlist(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $elders = Elder::orderBy('elders.id')
                ->get();
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
     * Display The Elder by specific id
     */

    public function showelderinformation(Request $request, $eldid)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            // $elder = DB::table('elders')
            //     ->join('users', 'users.id', '=', 'elders.user_id')
            //     ->where('elders.user_id', '=', $eldid)
            //     ->get();
            $elder = Elder::where('elders.id', '=', $eldid)
                ->leftJoin('assessments', 'assessments.elder_id', 'elders.id')
                ->where(function ($query) {
                    $query->WhereIn('elders.id', function ($subquery) {
                        $year = date('Y', strtotime(Carbon::now())) + 543;
                        $month = intval(date('m', strtotime(Carbon::now())));
                        $subquery->select('elders.id')
                            ->from('elders')
                            ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                            ->where('assessments.year', '=', $year)
                            ->where('assessments.month', '=', $month)
                            ->where('assessments.status', '=', 0);
                    })
                        ->orWhereNotIn('elders.id', function ($subquery) {
                            $year = date('Y', strtotime(Carbon::now())) + 543;
                            // $month = 1;
                            $month = intval(date('m', strtotime(Carbon::now())));
                            $subquery->select('elders.id')
                                ->from('elders')
                                ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                                ->where('assessments.year', '=', $year)
                                ->where('assessments.month', '=', $month);
                        });
                })
                ->select(
                    'elders.*',
                    'assessments.*'
                )
                ->get();
            return response([
                "data" => $elder,
            ]);
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

        // $year = date('Y', strtotime(Carbon::now())) + 543;
        // $month = 1;
        // // $month = intval(date('m', strtotime(Carbon::now())));


        $elders_incomplete = Elder::where('elders.volunteer_id', '=', $volid)
            ->join('users', 'users.id', '=', 'elders.user_id')
            ->where(function ($query) {
                $query->WhereIn('elders.user_id', function ($subquery) {
                    $year = date('Y', strtotime(Carbon::now())) + 543;
                    $month = intval(date('m', strtotime(Carbon::now())));
                    $subquery->select('elders.user_id')
                        ->from('elders')
                        ->join('assessments', 'assessments.elder_id', '=', 'elders.user_id')
                        ->where('assessments.year', '=', $year)
                        ->where('assessments.month', '=', $month)
                        ->where('assessments.status', '=', 0);
                })
                    ->orWhereNotIn('elders.user_id', function ($subquery) {
                        $year = date('Y', strtotime(Carbon::now())) + 543;
                        $month = intval(date('m', strtotime(Carbon::now())));
                        $subquery->select('elders.user_id')
                            ->from('elders')
                            ->join('assessments', 'assessments.elder_id', '=', 'elders.user_id')
                            ->where('assessments.year', '=', $year)
                            ->where('assessments.month', '=', $month);
                    });
            })
            ->orderBy('elders.user_id')
            ->get();

        $elders_complete = Elder::where('elders.volunteer_id', '=', $volid)
            ->join('users', 'users.id', '=', 'elders.user_id')
            ->where(function ($query) {
                $query->WhereIn('elders.user_id', function ($subquery) {
                    $year = date('Y', strtotime(Carbon::now())) + 543;
                    $month = intval(date('m', strtotime(Carbon::now())));
                    $subquery->select('elders.user_id')
                        ->from('elders')
                        ->join('assessments', 'assessments.elder_id', '=', 'elders.user_id')
                        ->where('assessments.year', '=', $year)
                        ->where('assessments.month', '=', $month)
                        ->where('assessments.status', '=', 1);
                });
            })
            ->orderBy('elders.user_id')
            ->get();

        return response([
            "data" => [
                'incomplete' => $elders_incomplete,
                'complete' => $elders_complete
            ],
        ], 200);
        // } else {
        //     return response([
        //         "message" => "Permission Denied.",
        //     ], 403);
        // }
    }

    /**
     * Display All Elder by specific Address(Tumbon, Moo)
     */
    public function showelderbyaddress(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $fields = $request->validate([
                "moo" => 'required|integer',
                "tambon" => 'required|string',
                "amphoe" => 'required|string',
            ]);
            $elders_incomplete = Elder::where('elders.moo', '=', $fields['moo'])
                ->where('elders.tambon', '=', $fields['tambon'])
                ->where('elders.amphoe', '=', $fields['amphoe'])
                ->where(function ($query) {
                    $query->WhereIn('elders.id', function ($subquery) {
                        $year = date('Y', strtotime(Carbon::now())) + 543;
                        $month = intval(date('m', strtotime(Carbon::now())));
                        $subquery->select('elders.id')
                            ->from('elders')
                            ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                            ->where('assessments.year', '=', $year)
                            ->where('assessments.month', '=', $month)
                            ->where('assessments.status', '=', 0);
                    })
                        ->orWhereNotIn('elders.id', function ($subquery) {
                            $year = date('Y', strtotime(Carbon::now())) + 543;
                            $month = intval(date('m', strtotime(Carbon::now())));
                            $subquery->select('elders.id')
                                ->from('elders')
                                ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                                ->where('assessments.year', '=', $year)
                                ->where('assessments.month', '=', $month);
                        });
                })
                ->orderBy('elders.id')
                ->get();

            $elders_complete = Elder::where('elders.moo', '=', $fields['moo'])
                ->where('elders.tambon', '=', $fields['tambon'])
                ->where('elders.amphoe', '=', $fields['amphoe'])
                ->where(function ($query) {
                    $query->WhereIn('elders.id', function ($subquery) {
                        $year = date('Y', strtotime(Carbon::now())) + 543;
                        $month = intval(date('m', strtotime(Carbon::now())));
                        $subquery->select('elders.id')
                            ->from('elders')
                            ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                            ->where('assessments.year', '=', $year)
                            ->where('assessments.month', '=', $month)
                            ->where('assessments.status', '=', 1);
                    });
                })
                ->orderBy('elders.id')
                ->get();

            $response = [
                'incomplete' => $elders_incomplete,
                'complete' => $elders_complete
            ];
            return response([
                "data" => $response
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function showelders(Request $request)
    {
        if ($request->user()->tokenCan("0") || $request->user()->tokenCan("1")) {
            $elders_incomplete = Elder::where(function ($query) {
                $query->WhereIn('elders.id', function ($subquery) {
                    $year = date('Y', strtotime(Carbon::now())) + 543;
                    $month = intval(date('m', strtotime(Carbon::now())));
                    $subquery->select('elders.id')
                        ->from('elders')
                        ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                        ->where('assessments.year', '=', $year)
                        ->where('assessments.month', '=', $month)
                        ->where('assessments.status', '=', 0);
                })
                    ->orWhereNotIn('elders.id', function ($subquery) {
                        $year = date('Y', strtotime(Carbon::now())) + 543;
                        $month = intval(date('m', strtotime(Carbon::now())));
                        $subquery->select('elders.id')
                            ->from('elders')
                            ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                            ->where('assessments.year', '=', $year)
                            ->where('assessments.month', '=', $month);
                    });
            })
                ->orderBy('elders.id')
                ->get();

            $elders_complete = Elder::where(function ($query) {
                $query->WhereIn('elders.id', function ($subquery) {
                    $year = date('Y', strtotime(Carbon::now())) + 543;
                    $month = intval(date('m', strtotime(Carbon::now())));
                    $subquery->select('elders.id')
                        ->from('elders')
                        ->join('assessments', 'assessments.elder_id', '=', 'elders.id')
                        ->where('assessments.year', '=', $year)
                        ->where('assessments.month', '=', $month)
                        ->where('assessments.status', '=', 1);
                });
            })
                ->orderBy('elders.id')
                ->get();

            $response = [
                'incomplete' => $elders_incomplete,
                'complete' => $elders_complete
            ];
            return response([
                "data" => $response
            ], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Update Elder Personal Info for Admin, Volunteer
     */
    public function updateelder(Request $request, $id)
    {
    }
}
