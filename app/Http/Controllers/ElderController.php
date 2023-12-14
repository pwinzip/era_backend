<?php

namespace App\Http\Controllers;

use App\Models\Elder;
use Illuminate\Http\Request;

class ElderController extends Controller
{
    /**
     * Display All Elder for Admin
     */
    public function showallelderlist() {

    }

    /**
     * Display All Elder by specific Address(Tumbon, Moo)
     */
    public function showelderbyaddress(Request $request) {
        if($request->user->tokenCan("0") || $request->user->tokenCan("1")) {
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
        }
        else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    /**
     * Add New Elder for Admin
     */
    public function newelder(Request $request) {
        
    }

    /**
     * Update Elder Personal Info for Admin, Volunteer
     */
    public function updateelder(Request $request, $id) {

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
