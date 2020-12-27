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
Route::get('/', function () {
    return view('home');
})->name('home');
Route::group(['middleware' => ['auth']], function() {

    Route::group(["prefix" => "user",'as' => 'user', 'namespace' => "User"], function() {
        Route::get('overview', 'UserController@dashboard')->name('.overview');
        Route::get('profile', 'UserController@profile')->name('.profile');
        Route::post('updateprofile', 'UserController@updateprofile')->name('.updateprofile');
        Route::get('changepassword', 'UserController@changepassword')->name('.changepassword');
        Route::post('postchangepassword', 'UserController@postchangepassword')->name('.postchangepassword');
        Route::get('company', 'UserController@company')->name('.company');
        Route::get('addcompany', 'UserController@company')->name('.addcompany');
    });
    Route::get('upgrade-to-seller', 'MainController@applyforseller')->name('upgradetoseller');
    Route::get('upgrade-to-seller', 'MainController@applyforseller')->name('upgradetoseller');
    Route::post('apply/for/seller/proccess', 'MainController@company_seller')->name('apply.seller.company');

});
