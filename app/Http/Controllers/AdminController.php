<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken('SalePhone')->accessToken;
            return response()->json(['access_token' => $token, 'user' => $user], 200);
        } else {
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không đúng'], 401);
        }
    }
    public function register(Request $request)
    {
        // $request->password = "DMC";
        $request->merge(['password' => Hash::make($request->input('password'))]);

        try {
            User::create($request->all());
            return response()->json(["message" => "User registered successfully"], 200);
        } catch (\Throwable $th) {
            return response()->json(["error" => "User registration failed"], 500);
        }
    }
}