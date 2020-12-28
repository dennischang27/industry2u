<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(["prefix" => "admin", "as" => "admin.", "namespace" => "Admin"], function() {
    Auth::routes([
        'register' => false
    ]);
    Route::post('/admin/login', 'Auth\LoginController@adminLogin');
    Route::group(['middleware' => ['auth:admin']], function() {
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::resource('roles','RoleController');
        Route::resource('users','UserController');
        Route::resource('products','ProductController');
        Route::resource('brands','BrandController');
        Route::resource('productcategories','ProductCategoryController');

    });

});

