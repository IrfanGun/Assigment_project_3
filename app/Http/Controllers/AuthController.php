<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $token = Auth::attempt(['email' => $email, 'password' => $password]);
        if(!$token) 
        {
             return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60*60
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->json
        ([
            'message' => 'logout succesfull'
            
        ]);
    }



    public function refresh()
    {
        return response()->json([
            'access_token' => Auth::refresh(),
            'token_type' => 'bearer',
            'expires_in' => 60*60
        ]);
    }
}
