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
Route::get('aboutus', 'HomeController@about_us')->name('about_us');
Route::get('company_profile/{id}', 'HomeController@companyprofile')->name('company_profile');
Route::get('product_show/{id}', 'HomeController@productshow')->name('product_show');
Route::get('contact_us', 'HomeController@contactus')->name('contact_us');
Route::post('contact_us_store', 'HomeController@contactus_store')->name('contact_us.store');
Route::get('terms_for_buyers_sellers', 'HomeController@termsbuysell')->name('termsbuysell');
Route::get('privacy/bm', 'HomeController@privacybm')->name('privacybm');
Route::get('products', 'ProductController@index')->name('public.products');
Route::get('supplier_list', 'HomeController@supplierlist')->name('supplier_list');
Route::get('FAQ', 'HomeController@faq')->name('faq');
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
        Route::group(['middleware' => ['CheckBuyer']], function() {
            Route::get('company', 'UserController@company')->name('.company');
            Route::get('company/edit', 'UserController@companyedit')->name('.company.edit');
            Route::post('company/{company}/update', 'UserController@companyupdate')->name('.company.update');
        });
    });

    Route::get('cart-view', 'CartController@index')->name('public.cart.view');
    Route::get('ajax/cart', 'CartController@ajaxcart')->name('public.cart.ajaxcart');
    Route::post('cart/update', 'CartController@update')->name('public.cart.update');
    Route::get('cart/remove/{company}/{product}', 'CartController@remove')->name('public.cart.remove');
    Route::get('cart-checkout', 'CartController@checkout')->name('public.cart.checkout');
    Route::put('cart-checkout/process', 'CartController@checkoutProcess')->name('public.cart.checkout.process');
    Route::post('add-to-cart', 'CartController@add')->name('public.cart.add');

    Route::get('addcompany', 'MainController@addcompany')->name('addcompany');
    Route::post('addcompany/proccess', 'MainController@addcompanypost')->name('addcompanypost');
    Route::get('apply-to-seller', 'MainController@applyforseller')->name('apply.seller.company');
    Route::post('apply-to-seller/proccess', 'MainController@applyforsellerpost')->name('apply.seller.company.post');
    Route::get('upgrade-to-seller', 'MainController@upgradetoseller')->name('upgrade.seller.company');
    Route::post('upgrade-to-seller/{company}/update', 'MainController@upgradetosellerpost')->name('upgrade.seller.company.post');

});
