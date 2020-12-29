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
Route::get('privacy', 'HomeController@privacy')->name('privacy');
Route::get('terms', 'HomeController@terms')->name('terms');
Route::get('privacy/bm', 'HomeController@privacybm')->name('privacybm');

Route::group(['middleware' => ['auth']], function() {

    Route::group(["prefix" => "user",'as' => 'user', 'namespace' => "User"], function() {
        Route::get('account', 'UserController@account')->name('.account');
        Route::get('profile', 'UserController@profile')->name('.profile');
        Route::post('users/{user}/update', 'UserController@updateprofile')->name('.updateprofile');
        Route::get('changepassword', 'UserController@changepassword')->name('.changepassword');
        Route::post('postchangepassword/{user}/update', 'UserController@postchangepassword')->name('.postchangepassword');
        Route::get('addcompany', 'UserController@addcompany')->name('.addcompany');
        Route::get('company', 'UserController@company')->name('.company');
    });

    Route::get('addcompany', 'MainController@addcompany')->name('addcompany');
    Route::get('addcompany/proccess', 'MainController@addcompanypost')->name('addcompanypost');
    Route::get('upgrade-to-seller', 'MainController@applyforseller')->name('upgradetoseller');
    Route::post('upgrade-to-seller/proccess', 'MainController@applyforsellerpost')->name('apply.seller.company');

});
