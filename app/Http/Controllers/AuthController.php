<?php

namespace App\Http\Controllers;

use App\Http\Requests\auth\LoginRequest;
use App\Http\Requests\auth\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::whereUsername($request->validated('username'))->first();
        if (!$user || !Hash::check($request->validated('password'), $user->password)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => UserResource::make($user)
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'username' => $request->validated('username'),
                'password' => $request->validated('password'),
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'token' => $token,
                'user' => UserResource::make($user)
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at creating user',
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function logout(Request $request): JsonResponse
    {
        try{
            $request->user()->tokens()->delete();
            return response(status: 200);
        }catch (\Throwable $e){
            return response()->json([
               'message' => 'Error at logging out',
               'error' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
