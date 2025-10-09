<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Auth::routes([
//     'reset' => false,
//     'verify' => false,
// ]);

Route::get('/', [PostController::class, 'index'])->name('posts.index');

Route::group([
	'middleware' => ['auth'],
], function () {
	Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

    Route::group([
        'middleware' => ['admin'],
    ],
    function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
    });
});


Route::get('/home', function () {
    return view('home');
})  ->middleware(['auth', 'verified'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::resource('posts', PostController::class);




require __DIR__.'/auth.php';
