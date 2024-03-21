<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 

class AuthController extends Controller
{
    
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response([
                'response' => 'Invalid Credentials',
                'message' => 'error'
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'profile' => auth()->user(),
            'access_token' => $accessToken,
            'message' => 'success'
        ]);
    }

    public function register(Request $request) {
        $registerData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ]);

        $userController = new UserController();
        $registerData['password'] = bcrypt($registerData['password']);
        $user = $userController->createUser($registerData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'profile' => $user,
            'access_token' => $accessToken,
            'message' => 'success',
        ]);
    }


    
}
