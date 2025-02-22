<?php

use App\Http\Controllers\BloodPressureController;
use App\Http\Controllers\HeartBeatController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [UserController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->prefix('users/{id}')->group(function() {
    Route::post('steps', [StepController::class, 'store']);
    Route::post('bloodPressures', [BloodPressureController::class, 'store']);
    Route::post('heartBeats', [HeartBeatController::class, 'store']);
    Route::post('medicalRecords', [MedicalRecordController::class, 'store']);
});
