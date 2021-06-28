<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => [
            'register', 'login'
        ]]);
    }
    public function user()
    {
        # code...
        return 'Authenticated user';
    }
    public function register(Request $request)
    {
        # code...
        $validated = $request->validate([

            'email' => 'required|email',
            'password' => 'required',
            'first_name' => 'required|max:50',
            'last_name' => 'required|max:50',



        ]);

        $user = User::create([
            "email" => $request->input("email"),
            "password" => Hash::make($request->input("password")),
            "first_name" => $request->input("first_name"),
            "last_name" => $request->input("last_name"),

        ]);


        return response([
            "message" => "created!",
            "user" => $user
        ], 200);
    }
    public function login(Request $request)
    {
        # code...
        $validated = $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (!Auth::attempt($request->only('email', 'password'))) {
            # code...

            return response([
                "message" => "Invalid Credentials"
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        $token =
            $user->createToken('token');
        return response([
            "user" => $user,
            "token" => $token->plainTextToken
        ], Response::HTTP_OK);
    }
    public function logout()
    {
        # code...
        $user = request()->user();
        //delete all tokens
        $user->tokens()->delete();

        return response([
            "message" => "logged out"
        ], 200);
    }
}
