<?php

namespace App\Http\Services;

use App\Models\User;
use App\Http\Traits\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    use JsonResponse;

    public function registration($request)
    {
        $user =  new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'user' => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ];
        return $this->successResponse($response, 'Registration Successful');
    }

    public function login($request)
    {
        $credentials = $request->only(['email', 'password']);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->errorResponse('Invalid credentials');
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $response = [
            'user' => $user,
            'access_token'  => $token,
            'token_type'    => 'Bearer'
        ];
        return $this->successResponse($response, 'Login successful');
    }
}
