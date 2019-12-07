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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');
Route::get('search', 'HomeController@search')->name('search');
Route::get('toCart', 'HomeController@store');
Auth::routes(['request' => false, 'reset' => false, 'email' => false]);
Route::get('cart', 'HomeController@get_cart')->name('cart')->middleware(['auth', 'user']);
Route::get('update_cart', 'HomeController@update_cart')->name('update_cart')->middleware(['auth', 'user']);
Route::get('delete_cart/{id}', 'HomeController@delete_cart')->name('delete_cart')->middleware(['auth', 'user']);
Route::get('submit_cart', 'HomeController@submit_cart')->name('submit_cart')->middleware(['auth', 'user']);
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' =>['auth', 'admin']], function () {
    Route::get('/', 'AdminHomeController@index')->name('index');
    Route::resource('cars', 'CarsController');
    Route::post('status', 'CarsController@status');
});


