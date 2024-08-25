<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserHasRole;
use App\Http\Middleware\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Admin routes
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admindashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    });

    // User routes
    Route::middleware(['is_user'])->group(function () {
        Route::get('/userdashboard', [UsersController::class, 'userdashboard'])->name('user.dashboard');
    });

    // General authenticated user routes
    Route::middleware('auth')->group(function () {
        Route::get('/data', [DashboardController::class, 'index'])->name('data.index');
        Route::get('/data/create', [DashboardController::class, 'create'])->name('data.create');
        Route::post('/data', [DashboardController::class, 'store'])->name('data.store');
        Route::get('data/{data}/edit', [DashboardController::class, 'edit'])->name('data.edit');
        Route::put('/data/{data}', [DashboardController::class, 'update'])->name('data.update');
        Route::delete('/data/{data}', [DashboardController::class, 'destroy'])->name('data.destroy');

        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

});

require __DIR__.'/auth.php';
