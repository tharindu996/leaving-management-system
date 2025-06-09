<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\LeaveController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::middleware(['can:admin'])->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::patch('/approve-leave/{leave}', [AdminLeaveController::class, 'approveLeave'])->name('leaves.approve-leave');
        Route::resource('leaves', AdminLeaveController::class)->only(['index', 'show']);
    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
