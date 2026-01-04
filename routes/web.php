<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChooseCryptocurrency;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ComputeController;
use App\Http\Controllers\AccountController;
/*
|--------------------------------------------------------------------------
| Public Routes (Guest)
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/verify', [AuthController::class, 'showVerify'])->name('verify');
Route::post('/verify', [AuthController::class, 'verify'])->name('verify.post');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/verify/resend', [AuthController::class, 'resend'])
    ->name('verify.resend');

Route::middleware('auth')->get('/invites', function () {
    return view('invites');
})->name('invites');

Route::middleware('auth')->group(function () {
    Route::get('/team', [\App\Http\Controllers\ReferralController::class, 'index'])
        ->name('team');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', fn () => view('settings'))->name('account.settings');
    Route::get('/account/password', fn () => view('password'))->name('account.password');
    Route::get('/about', fn () => view('about'))->name('about');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get(
        '/choose-cryptocurrency',
        [ChooseCryptocurrency::class, 'chooseCryptocurrency']
    )->name('choose.cryptocurrency');

    Route::get('/qr-code', [DepositController::class, 'showQrCode'])
        ->name('qr.code');


    Route::post('/compute/unlock/{id}', [ComputeController::class, 'unlock'])
        ->name('compute.unlock');

    Route::get('/compute/{plan}', [HomeController::class, 'showComputePlan'])
        ->name('compute.show');

    Route::get('/track', [ComputeController::class, 'track'])
        ->name('compute.track');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
