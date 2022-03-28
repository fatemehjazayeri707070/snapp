<?php

use Illuminate\Support\Facades\Route;
/* dafault laravel routes */

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/* dashboard routes */
Route::resource('shop', 'ShopController')->except('show');
Route::post('product/{id}/restore', 'ProductController@restore')->name('product.restore');
Route::resource('product', 'ProductController')->except('show');

/* public routes */
Route::get('landing/{page}', 'LandingController@loadPage')->name('landing');

// cart routes
Route::post('cart/add/{product}', 'CartController@add')->name('cart.add');