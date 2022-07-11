<?php

use App\Http\Controllers\Auth\AuthApi\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthApi\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\AuthApi\NewPasswordController;
use App\Http\Controllers\Auth\AuthApi\PasswordResetLinkController;
use App\Http\Controllers\Auth\AuthApi\RegisteredUserController;
use App\Http\Controllers\Auth\AuthApi\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::localized(function () {
    /********* Authentication API Routes *********/
    Route::middleware('guest')->group(function () {
        Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('password.update');
    });

    Route::middleware('auth')->group(function () {
        Route::middleware('throttle:6,1')->group(function () {
            Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed'])->name('verification.verify');

            Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->name('verification.send');
        });

        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    });

    /********* System Routes *********/
    Route::middleware(['auth:sanctum', 'verified'])->get('/user', function (Request $request) {
        return $request->user();
    });
});
