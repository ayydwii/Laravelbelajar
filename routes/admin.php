<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/users', function () {
    return view('admin.users');
})->name('admin.users');

Route::get('/posts', function () {
    return view('admin.posts');
})->name('admin.posts');

Route::get('/profile', function () {
    return view('admin.profile');
})->name('admin.profile');

?>
