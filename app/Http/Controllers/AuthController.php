<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function registration(RegistrationRequest $request)
    {
        return $this->authService->registration($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->authService->login($request);
    }
}
