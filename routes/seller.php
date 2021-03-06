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
           Route::get('/', 'SellerController@index')->name('dashboard');

            Route::get('products', 'ProductController@index')->name('products.index');
            Route::get('products/create', 'ProductController@create')->name('products.create');
            Route::post('products/store', 'ProductController@store')->name('products.store');
            Route::get('products/getproducts','ProductController@getproducts')->name('products.getproducts');

            Route::get('products/importproducts','ProductController@importproducts')->name('products.importproducts');


            Route::get('products/uploadfile','UploadController@uploadfile')->name('products.uploadfile');
            Route::post('products/uploadfile/process','UploadController@uploadfileprocess')->name('products.uploadfile.process');
            Route::get('products/file/delete/{value}','UploadController@deletefile')->name('products.file.delete');


            Route::get('products/{product}', 'ProductController@show')->name('products.show');
            Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
            Route::post('products/{product}/update', 'ProductController@update')->name('products.update');
            Route::post('products/{product}/delete', 'ProductController@destroy')->name('products.destroy');

            Route::get('products/category/attributes/retrive/{id}', 'ProductController@attributeajaxretrive')->name('products.categoryattributes.ajaxretrive');

            Route::post('products/template/upload', 'ProductUploadController@uploadTemplate')->name('products.template.upload');
            Route::get('products/template/download', 'ProductUploadController@downloadTemplate')->name('products.template.download');

            Route::get('file/{id}','ProductController@ajaxdelatt')->name('ajaxdelatt');
            Route::get('image/{id}','ProductController@ajaxdelimg')->name('ajaxdelimg');

            Route::get('company', 'CompanyController@index')->name('company.profile');
            Route::get('company/edit', 'CompanyController@edit')->name('company.profile.edit');
            Route::post('company/{company}/update', 'CompanyController@update')->name('company.profile.update');
            Route::get('account', 'sellerController@account')->name('account');

            Route::get('quote', 'QuotationController@quote')->name('quote');
            Route::get('quote/{qr_id}/details', 'QuotationController@quoteDetails')->name('quote.details');
            Route::post('quote/discount/add', 'QuotationController@adddiscount')->name('adddiscount');
            Route::post('quote/issue', 'QuotationController@quotationissue')->name('quotationissue');
            Route::get('quote/issued', 'QuotationController@quoteissued')->name('quote.issued');
            Route::post('quote/reject', 'QuotationController@quotereject')->name('quote.reject');
            Route::post('quote/term', 'QuotationController@quoteterm')->name('quote.term');
        });
});
