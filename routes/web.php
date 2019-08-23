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

Route::get('/', 'HomeController@index')->name('home');

Route::get('/auctions/{auction}/details', 'AuctionsController@details');

Route::middleware('auth')->group(function () {
    Route::resource('/auctions', 'AuctionsController');

    Route::post('/auctions/{auction}/bid', 'AuctionBidsController@store');

});
