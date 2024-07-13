<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse ;
class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        if(!$request->user()->staff_verified_at){
           Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            $response = collect([
                'message' => 'This account has not been activated',
                'status' => 'pending verification',
                'errors' => ['Authorization error'],
            ]);
             return response()->json($response, 401);
        }
        
        $request->session()->regenerate();

        $response = collect([
                'message' => 'Login successful.',
                'status' => 'active',
                'token' => Auth::user()->createToken("staff api token", 
                                    ['patient:create']
                                    )->plainTextToken,
                'errors' => [],
            ]);
         return response()->json($response, 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $response = collect([
                'message' => 'You have been logged out of your session.',
                'status' => 'inactive',
                'errors' => [],
            ]);
         return response()->json($response, 200);
    }
}
