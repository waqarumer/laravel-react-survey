<?php

namespace App\Http\Controllers;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function signup(SignupRequest $request ){

        $data = $request -> validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $token = $user -> createToken('main') -> plainTextToken;
        return response([
            'user' => $user,
            'token' => $token
        ]);


    }
    public function login(LoginRequest $request){

        $credantials = $request -> $request->validated();
        $remember = $credantials['remember'] ?? false;
        unset($credantials['remember']);

        if(!Auth::attempt($credantials,$remember)){
            return response([
                'error' => 'The Provided credantials are not correct'
            ],422);

            
        }
        $user = Auth::user();
        $token = $user->createToken('main')->plainTextToken;

        return response([
            'user' => $user,
            'token' => $token
        ]);

    }
    public function logout(Request $request){

        $user = Auth::user();
        $user->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);

    }
}
