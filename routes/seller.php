<?php

/*
|--------------------------------------------------------------------------
| Seller Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Seller routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(["prefix" => "seller", "as" => "seller.", "namespace" => "Seller"], function() {
    Auth::routes();
    Route::get('/', function () {
        return view('seller.home');
    });
    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', function () {
            return view('seller.home');
        });
    });
});
