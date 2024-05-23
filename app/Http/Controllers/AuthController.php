<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        try {
            //code...
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
    
            $user_data = array(
                'email'  => $request->get('email'),
                'password' => $request->get('password')
            );
    
            if (Auth::attempt($user_data)) {
                /** @var \App\Models\User $user **/
                $user = Auth::user();
                $token = $user->createToken('token-name')->plainTextToken;
    
                return response()->json(['token' => $token], 201);
            } else {
    
                // Authentication failed
                return response()->json(['message' => 'Invalid username or password'], 401);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['message' => $th], 500);
        }
        
    }

    public function getPermissions(Request $request){
        return response()->json([
            'roles' => auth('sanctum')->user()->getRoleNames(),
            'permissions' => auth('sanctum')->user()->getAllPermissions()->pluck('name')
        ]);
    }

    public function logout(Request $request){
        Auth::logout();

        // $request->user()->tokens()->delete();
        return response()->json(['message' => 'logged out'], 200);
    }
}
