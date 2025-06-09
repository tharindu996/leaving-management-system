<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:employee'])->prefix('/employee')->name('employee.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('leaves', LeaveController::class)->only(['index', 'store', 'show', 'update', 'destroy']);
    });
    Route::middleware(['can:admin'])->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::patch('/approve-leave/{leave}', [AdminLeaveController::class, 'approveLeave'])->name('leaves.approve-leave');
        Route::patch('/reject-leave/{leave}', [AdminLeaveController::class, 'rejectLeave'])->name('leaves.reject-leave');
        Route::resource('leaves', AdminLeaveController::class)->only(['index', 'show',]);
        Route::resource('users', AdminUserController::class)->only(['index']);
    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

Route::fallback(function () {
    if (Auth::check()) {

        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('employee.dashboard');
        }
        return redirect()->route('login');
    }
});
