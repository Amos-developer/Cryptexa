<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChooseCryptocurrency;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ComputeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\WithdrawalController;
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
    Route::get('/account', fn() => view('settings'))->name('account.settings');
    Route::get('/account/password', fn() => view('password'))->name('account.password');
    Route::get('/about', fn() => view('about'))->name('about');
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

    Route::post('/deposit', [DepositController::class, 'store'])
        ->name('deposit.store');

    Route::get('/deposit/{deposit}/qr', [DepositController::class, 'showQrCode'])
        ->name('deposit.qr');

    Route::get('/deposit/{deposit}/refresh-address', [DepositController::class, 'refreshAddress'])
        ->name('deposit.refresh-address');

    Route::post('/nowpayments/ipn', [\App\Http\Controllers\NowPaymentsWebhookController::class, 'handle'])
        ->name('nowpayments.ipn');

    Route::get('/deposit/success/{deposit?}', fn() => view('deposit-success'))
        ->name('deposit.success');

    Route::get('/deposit/cancel/{deposit?}', fn() => view('deposit-cancel'))
        ->name('deposit.cancel');

    Route::get('/withdraw', [WithdrawalController::class, 'index'])
        ->middleware('auth')
        ->name('withdraw');

    Route::post('/withdraw', [WithdrawalController::class, 'submit'])
        ->name('withdraw.submit')
        ->middleware('auth');

    Route::post('/withdraw/send-code', [WithdrawalController::class, 'sendCode'])
        ->name('withdraw.send-code')
        ->middleware('auth');

    Route::get('/withdraw/history', [WithdrawalController::class, 'history'])
        ->name('withdraw.history')
        ->middleware('auth');


    Route::post('/pools/activate/{id}', [ComputeController::class, 'activatePool'])
        ->name('pools.activate');

    Route::get('/compute/{plan}', [HomeController::class, 'showComputePlan'])
        ->name('compute.show');

    Route::get('/track', [ComputeController::class, 'track'])
        ->name('compute.track');

    // API endpoint for real-time order status polling
    Route::get('/api/orders/status', [ComputeController::class, 'statusApi'])
        ->name('api.orders.status');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index']);
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/deposits', [AdminDepositController::class, 'index']);
        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index']);

        Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve']);
        Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject']);
        Route::post('/withdrawals/{withdrawal}/complete', [AdminWithdrawalController::class, 'complete']);
    });

require __DIR__ . '/admin.php';
