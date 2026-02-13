<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ManagementController; // <--- O novo controlador
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
 // Aproveita e confirma este também
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    
    Route::get('/colaboradores', [ManagementController::class, 'users'])->name('system.users');
    Route::get('/historico', [ManagementController::class, 'logs'])->name('system.logs');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/ponto/registar', [DashboardController::class, 'registrarPonto'])->name('ponto.registar');
    Route::post('/user/almoco', [DashboardController::class, 'updateAlmoco'])->name('user.almoco');
});
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    
    Route::middleware(['can:admin-access'])->group(function () {
        Route::get('/admin/panel', [AdminController::class, 'index'])->name('admin.panel');
        Route::post('/admin/users/{user}/toggle-role', [AdminController::class, 'toggleRole'])->name('admin.users.toggle');
    });
});
Route::middleware(['auth', 'can:admin-access'])->group(function () {
    Route::get('/admin/statistics', [AdminController::class, 'statistics'])->name('admin.statistics');
});
Route::middleware(['auth'])->group(function () {

    Route::get('/meus-logs', [DashboardController::class, 'meusLogs'])->name('user.logs');


    Route::middleware(['can:admin-access'])->group(function () {
        Route::get('/admin/logs/{log}', [AdminController::class, 'showLog'])->name('admin.logs.show');
    });
});
require __DIR__.'/auth.php';