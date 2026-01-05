<?php
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DepositController;

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

Route::get('/dashboard', [AdminDashboardController::class, 'index']);

Route::get('/users', [UserController::class, 'index']);

});