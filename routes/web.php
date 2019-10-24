<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PagesController@index')->name('home');
Route::get('/about', 'PagesController@about');
Route::get('/products}','PagesController@products')->name('products.show');
Route::get('/cart','CartController@index')->name('cart');
Route::post('/cart/add','CartController@add')->name('cart.add');
Route::post('/cart/remove','CartController@remove')->name('cart.remove');
Route::post('/cart/update','CartController@update')->name('cart.update');
Route::get('/product/{product}','PagesController@product')->name('product');
Route::get('/checkout','CheckoutController@index')->name('checkout');
Route::post('/checkout/charge','CheckoutController@charge')->name('checkout.charge');

