<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[DashboardController::class,'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');

Route::get('/dashboard',[DashboardController::class,'index'])
    ->middleware(['auth','verified'])
    ->name('dashboard');

Route::post('check', [UserController::class, 'check'])->name('check')->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
