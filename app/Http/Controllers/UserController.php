<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AnomalyDetectionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        if(!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken($request->name)->plainTextToken;

        return response()->json(['token' => $token]);
    }

    public function check(AnomalyDetectionService $service, DashboardController $controller)
    {
        $user = Auth::user()->load(['medicalRecords', 'heartBeats', 'bloodPressures']);
        $result = $service->detectAnomaly($user->toArray());

        return $controller->index();
    }
}
