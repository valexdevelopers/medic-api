<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Validator;
use App\Http\Resources\StaffResource;
use App\Models\Staff;

class RegisterController extends Controller
{
    //

    public function store(Request $request){
    // validate incoming data
            $validatedData = Validator::make($request->all(), 
            [
                'firstname' => ['bail', 'required', 'string', 'min:3'],
                'lastname' => ['bail', 'required', 'string', 'min:3'],
                'username' => ['bail', 'required', 'string', 'min:3', 'unique:'.Staff::class],
                'password' => ['bail', 'required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            ]);

            if($validatedData->fails()){ 
                $response = collect([
                'message' => 'staff account creation failed',
                'status' => 'error',
                'errors' => $validatedData->errors(),
            ]);
                return response()->json($response, 401);
            }

            $staffCount = Staff::all();
            $staffCount =  $staffCount->count();
            
            // set first registered staff as super admin
            if($staffCount < 1){
                $staff_verified_at = new \DateTime();
                $role = 'superAdmin';
                $staff_verified_by = 'self';
            }
             $staff = Staff::create(
          
                [
                    'firstname' => $request->firstname,
                    'username' => $request->username,
                    'lastname' => $request->lastname,
                    'password' => Hash::make( $request->password),
                    'role' => $role ?? Null,
                    'staff_verified_at'=> $staff_verified_at ?? Null,
                    'staff_verified_by'=> $staff_verified_by ?? Null
                ]
            );
            if(!$staff){
                $response = collect([
                'message' => 'staff account creation failed',
                'status' => 'error',
                'errors' => 'Internal Server Error',
            ]);
                return response()->json($response, 500);
            }

            $response = collect([
                'message' => 'Registration successful. An admin will verify your account',
                'status' => 'pending verification',
                'token' => $staff->createToken("staff api token", 
                                    ['patient:create']
                                    )->plainTextToken,
                'errors' => [],
            ]);

            return response()->json($response, 201);

    }
}
