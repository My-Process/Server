<?php

use App\Http\Controllers\AuthApi\AuthenticatedSessionController;
use App\Http\Controllers\AuthApi\EmailVerificationNotificationController;
use App\Http\Controllers\AuthApi\NewPasswordController;
use App\Http\Controllers\AuthApi\PasswordResetLinkController;
use App\Http\Controllers\AuthApi\RegisteredUserController;
use App\Http\Controllers\AuthApi\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/api/register', [RegisteredUserController::class, 'store'])->name('register');

    Route::post('/api/login', [AuthenticatedSessionController::class, 'store'])->name('login');

    Route::post('/api/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::post('/api/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::middleware('throttle:6,1')->group(function () {
        Route::get('/api/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed'])->name('verification.verify');

        Route::post('/api/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
    });

    Route::post('/api/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
