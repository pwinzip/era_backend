<?php

namespace App\Http\Controllers;

use App\Models\Elder;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerAdmin(Request $request)
    {
        if ($request->user()->tokenCan("0")) {
            $fields = $request->validate([
                'prefix' => 'required|string',
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string',
            ]);
            $user = User::create([
                "prefix" => $fields['prefix'],
                "name" => $fields['name'],
                "username" => $fields['username'],
                "password" => Hash::make($fields['password']),
                "user_type" => 0, // admin
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response([
                "message" => "New Admin Added.",
            ], 201);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function registerVolunteer(Request $request)
    {
        if ($request->user()->tokenCan("0")) {
            $fields = $request->validate([
                'prefix' => 'required|string',
                'name' => 'required|string',
                'username' => 'required|string|unique:users,username',
                'password' => 'required|string',
                'moo' => 'required|integer',
                'tambon'  => 'required|string',
                'amphoe' => 'required|string',
            ]);
            $user = User::create([
                'prefix' => $fields['prefix'],
                "name" => $fields['name'],
                "username" => $fields['username'],
                "password" => Hash::make($fields['password']),
                "user_type" => 1, // volunteer
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $volunteer = Volunteer::create([
                "user_id" => $user->id,
                "moo" => $fields['moo'],
                "tambon" => $fields['tambon'],
                "amphoe" => $fields['amphoe'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response([
                "message" => "New Volunteer Added.",
            ], 201);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function registerElder(Request $request)
    {

        if ($request->user()->tokenCan("0")) {
            $fields = $request->validate([
                'prefix' => 'required|string',
                'name' => 'required|string',
                'code_name' => 'required|string',
                'house_no' => 'required|string',
                'moo' => 'required|integer',
                'tambon'  => 'required|string',
                'amphoe' => 'required|string',
            ]);
            $elder = Elder::create([
                "prefix" => $fields['prefix'],
                "name" => $fields['name'],
                "code_name" => $fields['code_name'],
                "house_no" => $fields['house_no'],
                "moo" => $fields['moo'],
                "tambon" => $fields['tambon'],
                "amphoe" => $fields['amphoe'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return response([
                "message" => "New Elder Added.",
            ], 201);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }

    public function alladminlist(Request $request)
    {
        if ($request->user()->tokenCan("0")) {
            $user = User::where('user_type', '=', 0)->get();
            return response(['data' => $user], 200);
        } else {
            return response([
                "message" => "Permission Denied.",
            ], 403);
        }
    }


    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $fields['username'])->first();

        // return response($request, 200);
        if (!$user || !Hash::check($fields["password"], $user->password)) {
            return response([
                "message" => "Invalid Login."
            ], 401);
        } else {
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent(), ["$user->user_type"])->plainTextToken;

            $id = $user->id;
            $type = $user->user_type;
            if ($type == 1) {
                $u2 = User::find($id)->volunteer;
                // Return go to volunteer page
            } else if ($type == 2) {
                $u2 = User::find($id)->elder;
                // Return go to elder page
            } else {
                // Return go to admin page
                $u2 = [];
            }

            $response = [
                "user" => $user,
                "user2" => $u2,
                "token" => $token,
            ];

            return response($response, 200);
        }
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response([
            "message" => "Logged Out"
        ], 200);
    }
}
