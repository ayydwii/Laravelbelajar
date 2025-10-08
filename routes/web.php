<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Auth::routes([
//     'reset' => false,
//     'verify' => false,
// ]);

Route::group([
	'middleware' => ['auth'],
], function () {
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // 🔽 Bagian middleware Admin sementara dikomentari biar bisa akses /users tanpa login admin
    Route::group([
        'middleware' => ['Admin'],
    ],
    function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
    });
});




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
