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
Route::get('terms_for_buyers_sellers', 'HomeController@termsbuysell')->name('termsbuysell');
Route::get('privacy/bm', 'HomeController@privacybm')->name('privacybm');
Route::get('products', 'ProductController@index')->name('public.products');
Route::get('productview/{product}/{slug}', 'ProductController@product_detail')->name('public.products.show');
Route::get('product/{category}/{categoryid}', 'ProductCategoryController@category')->name('public.productscategory');
Route::get('product/{category}/{subcategory}/{subcategoryid}', 'ProductCategoryController@subcategory')->name('public.productscategory.subcategory');

Route::group(['middleware' => ['auth']], function() {

    Route::group(["prefix" => "user",'as' => 'user', 'namespace' => "User"], function() {
        Route::get('account', 'UserController@account')->name('.account');
        Route::get('profile', 'UserController@profile')->name('.profile');
        Route::post('users/{user}/update', 'UserController@updateprofile')->name('.updateprofile');
        Route::get('changepassword', 'UserController@changepassword')->name('.changepassword');
        Route::post('postchangepassword/{user}/update', 'UserController@postchangepassword')->name('.postchangepassword');
        //Route::group(['middleware' => ['CheckBuyer']], function() {

            // Management Center
            Route::get('company', 'UserController@company')->name('.company');
            Route::get('company/edit', 'UserController@companyedit')->name('.company.edit');
            Route::post('company/{company}/update', 'UserController@companyupdate')->name('.company.update');
            Route::get('bankinfo', 'UserController@bankinfo')->name('.bankinfo');
            Route::get('bankinfo/add', 'UserController@bankinfoadd')->name('.bankinfo.add');
            Route::post('bankinfo/{company}/add', 'UserController@bankinfoaddpost')->name('.bankinfo.store');
            Route::get('bankinfo/edit', 'UserController@bankinfoedit')->name('.bankinfo.edit');

            // Discount
            Route::get('discount', 'DiscountController@index')->name('.discount.index');
            Route::get('discount/master', 'DiscountController@master')->name('.discount.masters');
            Route::get('discount/manager', 'DiscountController@manager')->name('.discount.manager');
            Route::get('discount/sales', 'DiscountController@sales')->name('.discount.sales');
            
            Route::post('discount/master', 'DiscountController@masterCreate')->name('discount.master');
            Route::post('discount/manager', 'DiscountController@managerCreate')->name('discount.manager');
            Route::post('discount/sales', 'DiscountController@salesCreate')->name('discount.sales');
            
            // Seller Center
            // Product Management

            // my product
            // Route::get('sales/myProduct', 'ProductController@index')->name('.sales.myproduct');
            
            // add product
            // Route::get('sales/addProduct', 'ProductController@create')->name('.sales.addproduct');
            // Route::post('sales/store', 'ProductController@store')->name('sales.store');

            // Route::get('products/{product}', 'ProductController@show')->name('products.show');
            // Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit');
            // Route::post('products/{product}/update', 'ProductController@update')->name('products.update');
            // Route::post('products/{product}/delete', 'ProductController@destroy')->name('products.destroy');
            
            // Route::get('products/category/attributes/retrive/{id}', 'ProductController@attributeajaxretrive')->name('products.categoryattributes.ajaxretrive');


            // Route::post('products/template/upload', 'ProductUploadController@uploadTemplate')->name('products.template.upload');
            // Route::get('products/template/download', 'ProductUploadController@downloadTemplate')->name('products.template.download');

            // Route::get('file/{id}','ProductController@ajaxdelatt')->name('ajaxdelatt');
            // Route::get('image/{id}','ProductController@ajaxdelimg')->name('ajaxdelimg');
            
            // import products
            // Route::get('sales/importProduct','ProductController@importproducts')->name('.sales.importproduct');
            
            // upload files
            // Route::get('sales/uploadFile','UploadController@uploadfile')->name('.sales.uploadfile');
            // Route::post('sales/uploadfile/process','UploadController@uploadfileprocess')->name('.sales.uploadfile.process');
            // Route::get('sales/file/delete/{value}','UploadController@deletefile')->name('.sales.file.delete');


            // Customer Management
            // new customer
            Route::get('sales/customermanagement/newcustomer', 'CustomerManagementController@newcustomerindex')->name('.customermanagement.newcustomerindex');
            Route::post('sales/customermanagement/newcustomerassign', 'CustomerManagementController@newcustomerassign')->name('.customermanagement.newcustomerassign');

            // my customer
            // Route::get('sales/customermanagement/mycustomer', 'CustomerManagementController@mycustomerindex')->name('.customermanagement.mycustomer.index');
            // Route::get('sales/customermanagement/mycustomer/details', 'CustomerManagementController@mycustomerDetails')->name('.customermanagement.mycustomer.detials');
            // Route::get('sales/customermanagement/mycustomer/mange', 'CustomerManagementController@mycustomerManage')->name('.customermanagement.mycustomer.manage');


            // Pricing Management 
            Route::get('sales/pricingmanagement', 'PriceManagementController@index')->name('.pricemanagement.index');


        //});
    });

    Route::get('cart-view', 'CartController@index')->name('public.cart.view');
    Route::get('ajax/cart', 'CartController@ajaxcart')->name('public.cart.ajaxcart');
    Route::post('cart/update', 'CartController@update')->name('public.cart.update');
    Route::get('cart/remove/{company}/{product}', 'CartController@remove')->name('public.cart.remove');
    Route::get('cart-checkout', 'CartController@checkout')->name('public.cart.checkout');
    Route::put('cart-checkout/process', 'CartController@checkoutProcess')->name('public.cart.checkout.process');
    Route::post('add-to-cart', 'CartController@add')->name('public.cart.add');

    Route::group(['middleware' => ['CheckCompanyRegistration']], function() {
		Route::get('addcompany', 'MainController@addcompany')->name('addcompany');
		Route::post('addcompany/proccess', 'MainController@addcompanypost')->name('addcompanypost');
		Route::get('apply-to-seller', 'MainController@applyforseller')->name('apply.seller.company');
		Route::post('apply-to-seller/proccess', 'MainController@applyforsellerpost')->name('apply.seller.company.post');
		Route::get('upgrade-to-seller', 'MainController@upgradetoseller')->name('upgrade.seller.company');
		Route::post('upgrade-to-seller/{company}/update', 'MainController@upgradetosellerpost')->name('upgrade.seller.company.post');
	});

});
