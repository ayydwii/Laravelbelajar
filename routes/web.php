<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// Halaman utama (Blog)
Route::get('/', [BlogController::class, 'index'])->name('blog');

// Semua route berikut butuh login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Hanya admin yang bisa kelola user
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Post (bisa diakses admin & user yang login)
    Route::resource('posts', PostController::class);

    // Logout (POST)
    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});

// Home (redirect untuk user login)
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

require __DIR__ . '/auth.php';
