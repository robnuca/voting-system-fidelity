<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ChoiceController;
use Illuminate\Support\Facades\Log;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('email/verification-notification', [AuthController::class, 'sendVerificationEmail'])
    ->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::get('email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
    ->middleware(['auth:sanctum', 'signed'])->name('verification.verify');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('choices', [ChoiceController::class, 'index']);
    Route::post('vote', [VoteController::class, 'store']);
});
