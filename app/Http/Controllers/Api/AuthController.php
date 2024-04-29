<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request): string
    {
        $doesUserExist = User::where('email', $request->email)->exists();
        if ($doesUserExist) {
            return response()->json(
                [
                    'status' => false,
                    'data' => 'User with such email already exists',
                ], 400
            );
        }

        $user = User::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]
        );

        $token = $user->createToken('default')->plainTextToken;

        return response()->json(
            [
                'status' => true,
                'data' => $token,
            ]
        );
    }

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();

        if(!$user) {
            return response()->json([
                'success' => false,
                'data' => 'Wrong email! User does not exist =('
            ], 400);
        }

        if(!Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'data' => 'Wrong password'
            ], 400);
        }

        $token = $user->createToken('default')->plainTextToken;

        return response()->json([
            'success' => true,
            'data' => [
                'token' => $token
            ]
        ]);
    }
}
