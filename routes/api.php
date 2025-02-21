<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->prefix('users/{id}')->group(function() {
    Route::apiResource('steps', App\Http\Controllers\StepController::class);
    Route::apiResource('bloodPressures', App\Http\Controllers\BloodPressureController::class);
    Route::apiResource('heartBeats', App\Http\Controllers\HeartBeatController::class);
    Route::apiResource('medicalRecords', App\Http\Controllers\MedicalRecordController::class);
});
