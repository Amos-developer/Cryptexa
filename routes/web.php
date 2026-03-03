<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
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
use App\Http\Controllers\CheckInController;
use App\Http\Controllers\LuckyBoxController;
use App\Http\Controllers\WithdrawalMethodController;
use App\Http\Controllers\LanguageController;
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

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotForm'])->name('forgot.password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('forgot.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('reset.password');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('reset.password.post');

Route::middleware('require.2fa.pending')->group(function () {
    Route::get('/two-factor/login', [TwoFactorController::class, 'showLoginVerification'])->name('two-factor.login');
    Route::post('/two-factor/login/verify', [TwoFactorController::class, 'verifyLogin'])->name('two-factor.login.verify');
});

Route::post('/verify/resend', [AuthController::class, 'resend'])
    ->name('verify.resend');

// Language change route (accessible to all)
Route::post('/language/change', [LanguageController::class, 'change'])->name('language.change');

Route::middleware('auth')->get('/invites', function () {
    return view('invites');
})->name('invites');

Route::middleware('auth')->group(function () {
    Route::get('/team', [\App\Http\Controllers\ReferralController::class, 'index'])
        ->name('team');
    Route::get('/weekly-salary', [\App\Http\Controllers\ReferralController::class, 'weeklySalary'])
        ->name('weekly-salary');
    Route::get('/leaderboard', [\App\Http\Controllers\ReferralController::class, 'leaderboard'])
        ->name('leaderboard');
    Route::get('/rank-guide', fn() => view('referral.rank-guide'))
        ->name('rank-guide');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', function() {
        app()->setLocale(session('locale', config('app.locale')));
        return view('settings');
    })->name('account.settings');
    Route::get('/account/password', fn() => view('password'))->name('account.password');
    Route::post('/account/password', [AuthController::class, 'updatePassword'])->name('account.password.update');
    Route::get('/about', fn() => view('about'))->name('about');
    Route::get('/notifications', function() {
        $notifications = \App\Models\Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('notifications', compact('notifications'));
    })->name('notifications');

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

    // Withdrawal Method route
    Route::get('/withdrawal-method', fn() => view('withdrawal.method'))->name('withdrawal-method');
    Route::post('/withdrawal-method', [WithdrawalMethodController::class, 'store'])->name('withdrawal-method.store');
    
    // Settings pages
    Route::get('/settings/language', fn() => view('settings.language'))->name('settings.language');
    Route::get('/settings/theme', fn() => view('settings.theme'))->name('settings.theme');
    Route::get('/settings/notifications', fn() => view('settings.notifications'))->name('settings.notifications');
    Route::get('/settings/kyc', fn() => view('settings.kyc'))->name('settings.kyc');
    Route::get('/settings/system-time', fn() => view('settings.system-time'))->name('settings.system-time');
    Route::get('/deposit/history', function() {
        $deposits = \App\Models\Deposit::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('deposit-history', compact('deposits'));
    })->name('deposit.history');
});


/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [HomeController::class, 'home'])->name('home');

    Route::get(
        '/select-network',
        [ChooseCryptocurrency::class, 'chooseCryptocurrency']
    )->name('select.network');

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

    Route::post('/withdraw/verify-code', [WithdrawalController::class, 'verifyCode'])
        ->name('withdraw.verify-code')
        ->middleware('auth');

    Route::get('/withdraw/history', [WithdrawalController::class, 'history'])
        ->name('withdraw.history')
        ->middleware('auth');

    Route::get('/checkin', [CheckInController::class, 'index'])
        ->name('checkin');

    Route::post('/checkin', [CheckInController::class, 'store'])
        ->name('checkin.store');

    Route::get('/luckybox', [LuckyBoxController::class, 'index'])
        ->name('luckybox');

    Route::post('/luckybox/open', [LuckyBoxController::class, 'open'])
        ->name('luckybox.open');


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

    Route::post('/api/notifications/preferences', [NotificationController::class, 'updatePreferences'])
        ->name('api.notifications.preferences');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Admin Routes
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
        Route::get('/deposits/create', [AdminDepositController::class, 'create'])->name('deposits.create');
        Route::post('/deposits', [AdminDepositController::class, 'store'])->name('deposits.store');
        Route::get('/deposits/{deposit}/edit', [AdminDepositController::class, 'edit'])->name('deposits.edit');
        Route::put('/deposits/{deposit}', [AdminDepositController::class, 'update'])->name('deposits.update');
        
        Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
        Route::get('/withdrawals/create', [AdminWithdrawalController::class, 'create'])->name('withdrawals.create');
        Route::post('/withdrawals', [AdminWithdrawalController::class, 'store'])->name('withdrawals.store');
        Route::get('/withdrawals/{withdrawal}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');
        Route::get('/withdrawals/{withdrawal}/edit', [AdminWithdrawalController::class, 'edit'])->name('withdrawals.edit');
        Route::put('/withdrawals/{withdrawal}', [AdminWithdrawalController::class, 'update'])->name('withdrawals.update');
        
        Route::resource('pools', \App\Http\Controllers\Admin\AdminPoolController::class);
        Route::resource('user-pools', \App\Http\Controllers\Admin\AdminUserPoolController::class);
        
        Route::get('/settings', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'index'])->name('settings.index');
        Route::put('/settings', [\App\Http\Controllers\Admin\AdminSettingsController::class, 'update'])->name('settings.update');
        
        Route::get('/rewards', [\App\Http\Controllers\Admin\RewardsController::class, 'index'])->name('rewards.index');
        Route::delete('/rewards/commission/{id}', [\App\Http\Controllers\Admin\RewardsController::class, 'destroyCommission'])->name('rewards.commission.destroy');
        Route::delete('/rewards/checkin/{id}', [\App\Http\Controllers\Admin\RewardsController::class, 'destroyCheckin'])->name('rewards.checkin.destroy');
        Route::delete('/rewards/luckybox/{id}', [\App\Http\Controllers\Admin\RewardsController::class, 'destroyLuckyBox'])->name('rewards.luckybox.destroy');
        
        Route::get('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile', [\App\Http\Controllers\Admin\AdminProfileController::class, 'update'])->name('profile.update');
        
        Route::get('/admins', [\App\Http\Controllers\Admin\AdminManagementController::class, 'index'])->name('admins.index');
        Route::get('/admins/create', [\App\Http\Controllers\Admin\AdminManagementController::class, 'create'])->name('admins.create');
        Route::post('/admins', [\App\Http\Controllers\Admin\AdminManagementController::class, 'store'])->name('admins.store');
        Route::delete('/admins/{admin}', [\App\Http\Controllers\Admin\AdminManagementController::class, 'destroy'])->name('admins.destroy');
        
        Route::resource('commissions', \App\Http\Controllers\Admin\CommissionController::class)->except(['create', 'store']);
        Route::resource('rank-bonuses', \App\Http\Controllers\Admin\RankBonusController::class)->except(['create', 'store']);
        Route::resource('checkins', \App\Http\Controllers\Admin\AdminCheckInController::class)->except(['create', 'store']);
        Route::resource('lucky-boxes', \App\Http\Controllers\Admin\LuckyBoxController::class)->except(['create', 'store']);
        
        Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
        Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
        Route::post('/withdrawals/{withdrawal}/complete', [AdminWithdrawalController::class, 'complete'])->name('withdrawals.complete');
    });

require __DIR__ . '/admin.php';

// Public NOWPayments IPN (webhook) - must be reachable by NOWPayments (no auth/CSRF)
Route::post('/nowpayments/ipn', [\App\Http\Controllers\NowPaymentsWebhookController::class, 'handle'])
    ->name('nowpayments.ipn');

// NOWPayments Payout Webhook
Route::post('/nowpayments/payout-webhook', [\App\Http\Controllers\NowPaymentsPayoutWebhookController::class, 'handle'])
    ->name('nowpayments.payout.webhook');

// Automation endpoint for localhost (remove in production)
Route::get('/automation/run', [\App\Http\Controllers\AutomationController::class, 'runAll'])
    ->name('automation.run');
