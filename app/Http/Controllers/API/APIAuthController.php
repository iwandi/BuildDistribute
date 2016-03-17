<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class APIAuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid credentials'], 401);
            }
        }
        catch (JWTException $e) {
            return response()->json(['error' => 'could not create token'], 500);
        }

        // if no errors are encountered we can return a JWT
        return response()->json(compact('token'));
    }

    public function getAuthenticatedUser(Request $request)
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['error' => 'user not found'], 404);
            }
			
			$user = User::find($user->id);
			
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['error' => 'expired token'], $e->getStatusCode());
        }
        catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'invalid token'], $e->getStatusCode());
        }
        catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['error' => 'token absent'], $e->getStatusCode());
        }

        return response()->json($user);
    }
}
