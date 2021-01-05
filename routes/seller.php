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

        Route::group(['middleware' => ['CheckSeller']], function() {
            Route::get('/', 'sellerController@index')->name('dashboard');
            Route::resource('products','ProductController');
            Route::get('company', 'CompanyController@index')->name('company.profile');
            Route::get('company/edit', 'CompanyController@edit')->name('company.profile.edit');
            Route::post('company/{company}/update', 'CompanyController@update')->name('company.profile.update');
            Route::get('account', 'sellerController@account')->name('account');
        });
});
