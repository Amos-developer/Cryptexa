<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChooseCryptocurrency;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ComputeController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\NotificationController;
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

Route::middleware('require.2fa.pending')->group(function () {
    Route::get('/two-factor/login', [TwoFactorController::class, 'showLoginVerification'])->name('two-factor.login');
    Route::post('/two-factor/login/verify', [TwoFactorController::class, 'verifyLogin'])->name('two-factor.login.verify');
});

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
    Route::post('/account/password', [AuthController::class, 'updatePassword'])->name('account.password.update');
    Route::get('/about', fn() => view('about'))->name('about');

    // Two-Factor Authentication routes
    Route::get('/account/two-factor', [TwoFactorController::class, 'show'])->name('two-factor.show');
    Route::post('/account/two-factor/generate', [TwoFactorController::class, 'generateSecret'])->name('two-factor.generate');
    Route::post('/account/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify');
    Route::post('/account/two-factor/disable', [TwoFactorController::class, 'disable'])->name('two-factor.disable');

    // Withdrawal PIN routes
    Route::get('/withdrawal-pin/set', [\App\Http\Controllers\WithdrawalPinController::class, 'showSet'])->name('withdrawal-pin.set');
    Route::post('/withdrawal-pin/set', [\App\Http\Controllers\WithdrawalPinController::class, 'store'])->name('withdrawal-pin.store');
    Route::get('/withdrawal-pin/change', [\App\Http\Controllers\WithdrawalPinController::class, 'showChange'])->name('withdrawal-pin.change');
    Route::put('/withdrawal-pin/change', [\App\Http\Controllers\WithdrawalPinController::class, 'update'])->name('withdrawal-pin.update');
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

    Route::get('/deposit/{deposit}/check-status', [DepositController::class, 'checkStatus'])
        ->name('deposit.check-status');



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

    // Notification API endpoints
    Route::get('/api/notifications', [NotificationController::class, 'index'])
        ->name('api.notifications.index');

    Route::get('/api/notifications/unread-count', [NotificationController::class, 'unreadCount'])
        ->name('api.notifications.unread-count');

    Route::post('/api/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('api.notifications.mark-as-read');

    Route::post('/api/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('api.notifications.mark-all-as-read');

    Route::delete('/api/notifications/{id}', [NotificationController::class, 'delete'])
        ->name('api.notifications.delete');

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

// Public NOWPayments IPN (webhook) - must be reachable by NOWPayments (no auth/CSRF)
Route::post('/nowpayments/ipn', [\App\Http\Controllers\NowPaymentsWebhookController::class, 'handle'])
    ->name('nowpayments.ipn');
