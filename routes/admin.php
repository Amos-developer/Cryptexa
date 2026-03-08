<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\Admin\AdminWithdrawalController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CommissionController;
use App\Http\Controllers\Admin\AdminSettingsController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    
    // Deposits
    Route::get('/deposits', [AdminDepositController::class, 'index'])->name('deposits.index');
    Route::get('/deposits/{deposit}', [AdminDepositController::class, 'show'])->name('deposits.show');
    Route::post('/deposits/{deposit}/approve', [AdminDepositController::class, 'approve'])->name('deposits.approve');
    
    // Withdrawals
    Route::get('/withdrawals', [AdminWithdrawalController::class, 'index'])->name('withdrawals.index');
    Route::get('/withdrawals/{withdrawal}', [AdminWithdrawalController::class, 'show'])->name('withdrawals.show');
    Route::post('/withdrawals/{withdrawal}/approve', [AdminWithdrawalController::class, 'approve'])->name('withdrawals.approve');
    Route::post('/withdrawals/{withdrawal}/reject', [AdminWithdrawalController::class, 'reject'])->name('withdrawals.reject');
    Route::post('/withdrawals/{withdrawal}/complete', [AdminWithdrawalController::class, 'complete'])->name('withdrawals.complete');
    
    // Settings
    Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings.index');
    Route::post('/maintenance/cache-clear', [AdminSettingsController::class, 'cacheClean'])->name('maintenance.cache-clear');
    Route::post('/maintenance/config-clear', [AdminSettingsController::class, 'configClear'])->name('maintenance.config-clear');
    Route::post('/maintenance/view-clear', [AdminSettingsController::class, 'viewClear'])->name('maintenance.view-clear');
    Route::post('/maintenance/route-clear', [AdminSettingsController::class, 'routeClear'])->name('maintenance.route-clear');
    Route::post('/maintenance/optimize', [AdminSettingsController::class, 'optimize'])->name('maintenance.optimize');
    Route::post('/maintenance/optimize-clear', [AdminSettingsController::class, 'optimizeClear'])->name('maintenance.optimize-clear');
    Route::post('/maintenance/logs-clear', [AdminSettingsController::class, 'logsClear'])->name('maintenance.logs-clear');
});
