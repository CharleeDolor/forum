<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
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
    }

    public function logout(Request $request){
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json(['message' => 'logged out'], 201);
    }
}
