<?php

use App\Http\Controllers\Auth\AuthWeb\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthWeb\EmailVerificationPromptController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/********* Authentication Routes *********/
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

/********* System Routes *********/
Route::redirect('/', '/login');

Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
