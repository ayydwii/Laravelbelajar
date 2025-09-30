<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('posts', PostController::class);


Route::resource('users', UserController::class);


// Route::get('/product', function () {
//     return view('product.hello');
// });

// Route::get('/about', function () {
//     return Hello;
// });

//


// TUGAS MAS IVAN CHEEECK
// Tugas 1, buat route untuk menampilkan bilangan ganjil/genap

// Ini cara 1, pakai controller
// Route::get('/ganjil/{number}', [App\Http\Controllers\NumberController::class, 'isOdd']);

// Ini cara 2, langsung di web.php
// Route::get('/ganjil/{number}', function ($number) {
//     if ($number % 2 != 0) {
//         return "$number adalah bilangan ganjil.";
//     } else {
//         return "$number bukan bilangan ganjil.";
//     }
// });


// Tugas 2, bikin route untuk CRUD Post dengan kolom => id, title, content dan outputnya adalah data dari post
Route::resource('posts', PostController::class);



