<?php

use Illuminate\Support\Facades\Route;
/* dafault laravel routes */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/* admin routes */
Route::resource('shop', 'ShopController')->except('show');
Route::resource('product', 'ProductController')->except('show');
