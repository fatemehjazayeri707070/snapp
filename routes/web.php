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
Route::post('cart/manage/{product}', 'CartController@manage')->name('cart.manage');
Route::post('cart/finish', 'CartController@finish')->name('cart.finish');
Route::delete('cart/{cart_item}', 'CartController@remove')->name('cart.remove');