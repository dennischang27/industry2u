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


        Route::group(["as" => "ecommerce."], function() {
            Route::get('products/import','ProductController@productsImport')->name('productsImport');
            Route::post('products/template/upload', 'ProductUploadController@uploadTemplate')->name('products.template.upload');
            Route::get('products/template/download', 'ProductUploadController@downloadTemplate')->name('products.template.download');
            Route::resource('products','ProductController');
            Route::resource('brands','BrandController');
            Route::resource('productcategories','ProductCategoryController');
            Route::get('productcategories/attributes/store/{id}', 'ProductCategoryController@attributeajaxstore')->name('productcategories.attributes.ajaxadd');
            Route::get('productcategories/attributes/delete/{id}', 'ProductCategoryController@attributeajaxdestroy')->name('productcategories.attributes.ajaxdelete');
            Route::resource('attributes','AttributeController');
            Route::resource('attributemeasurements','AttributeMeasurementController');
            Route::get('attributes/attributemeasurements/update/{id}', 'AttributeMeasurementController@ajaxupdate')->name('attributes.attributemeasurements.ajaxupdate');
            Route::get('attributes/attributemeasurements/store/{id}', 'AttributeMeasurementController@ajaxstore')->name('attributes.attributemeasurements.ajaxadd');
            Route::get('attributes/attributemeasurements/delete/{id}', 'AttributeMeasurementController@ajaxdestroy')->name('attributes.attributemeasurements.ajaxdelete');
        });
        Route::group(["as" => "users."], function() {
            Route::resource('roles','RoleController');
            Route::resource('users','UserController');
            Route::resource('permissions','PermissionController');

        });

        Route::group(["as" => "transactions."], function() {
            Route::resource('ir','ItemRequestController');

        });
        Route::get('/clear-cache',function(){
            Artisan::call('cache:clear');
            Artisan::call('view:cache');
            Artisan::call('view:clear');

           // notify()->success("Cache has been cleared !");
            return back();
        })->name('clear-cache');
    });

});

