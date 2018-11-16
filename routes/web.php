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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('customers', 'CustomerController');
Route::resource('categories', 'CategoryController');
Route::resource('units', 'UnitController');
Route::resource('products', 'ProductController');

Route::prefix('carts')->group(function () {
	Route::get('', 'CartController@index')->name('carts.index');
	Route::put('update', 'CartController@update')->name('carts.update');
	Route::delete('{id}', 'CartController@destroy')->name('carts.destroy');
});

Route::resource('orders', 'OrderController')->only([
	'index', 'show', 'store'
]);
Route::get('/{id}}', 'OrderController@print_bill')->name('orders.print_bill');

Route::post('/add-to-cart/{product_id}', 'ProductController@add_to_cart')->name('products.add_to_cart');

//search route