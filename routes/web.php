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
Route::get('faq', 'HomeController@faq')->name('faq');
Route::get('productview/{product}/{slug}', 'ProductController@product_detail')->name('public.products.show');
Route::get('product/{category}/{categoryid}', 'ProductCategoryController@category')->name('public.productscategory');
Route::get('product/{category}/{subcategory}/{subcategoryid}', 'ProductCategoryController@subcategory')->name('public.productscategory.subcategory');
Route::group(['middleware' => ['auth']], function() {

    Route::group(["prefix" => "buyer",'as' => 'buyer', 'namespace' => "Buyer"], function() {
        Route::get('quote', 'QuotationController@quote')->name('.quote');
        Route::post('quote/request', 'QuotationController@quotationrequest')->name('.quotationrequest');
        Route::post('quote/reject', 'QuotationController@rejectquotationrequest')->name('.rejectquotationrequest');
        Route::post('quote/cancel', 'QuotationController@cancelquotationrequest')->name('.cancelquotationrequest');
        Route::get('quote/issued', 'QuotationController@quoteissued')->name('.quote.issued');
        Route::post('quote/rejected', 'QuotationController@rejectquotation')->name('.rejectquotation');
        Route::post('quote/accepted', 'QuotationController@quotation')->name('.quotation');
        Route::get('quote/request/file', 'QuotationController@quoterequestfile')->name('.quote.request.file');
        Route::get('quote/request/file/products', 'QuotationController@quoterequestfileproducts')->name('.quote.request.file.products');
        Route::get('quote/file', 'QuotationController@quotefile')->name('.quote.file');
        Route::get('quote/file/products', 'QuotationController@quotefileproducts')->name('.quote.file.products');
        //Route::get('quotationrequestview',array('as'=>'quotationrequestview','uses'=>'QuotationController@quotationrequestview'))->name('.quotationrequestview');
        Route::get('quotationrequest/view', 'QuotationController@quotationrequestview')->name('.quotationrequestview');
        Route::get('quotation/view', 'QuotationController@quotationview')->name('.quotationview');
    });

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
            Route::post('become/purchaser', 'UserController@becomepurchaser')->name('.become.purchaser');
            Route::post('company/{company}/update', 'UserController@companyupdate')->name('.company.update');

            Route::get('bankinfo', 'UserController@bankinfo')->name('.bankinfo');
            Route::get('bankinfo/add', 'UserController@bankinfoadd')->name('.bankinfo.add');
            Route::post('bankinfo/{company}/add', 'UserController@bankinfoaddpost')->name('.bankinfo.store');
            Route::get('bankinfo/edit', 'UserController@bankinfoedit')->name('.bankinfo.edit');

            Route::get('invite', 'UserController@invite')->name('.invite');
            Route::post('designation', 'UserController@getdesignation')->name('.designation');
            Route::post('sendinvitation/{user}', 'UserController@sendinvitation')->name('.sendinvitation');
            Route::post('joincompany/{user}', 'UserController@joincompany')->name('.joincompany');

            Route::get('manage', 'UserController@manage')->name('.manage');
            Route::get('manage/{user}/edit', 'UserController@manageedit')->name('.manage.edit');
            Route::post('manage/{user}/update', 'UserController@manageeditupdate')->name('.manage.update');

            Route::get('reporting', 'UserController@reporting')->name('.reporting');
            Route::get('reporting/{user}/edit', 'UserController@reportingedit')->name('.reporting.edit');
            Route::post('reporting/{user}/update', 'UserController@reportingupdate')->name('.reporting.update');


            Route::get('discount', 'DiscountSettingsController@masterIndex')->name('.discount.index');
            Route::get('discount/master', 'DiscountSettingsController@masterCreate')->name('.discount.masters');
            Route::post('discount/master', 'DiscountSettingsController@masterStore')->name('discount.masters');


            // Seller Center
            // Pricing Management (Discount Settings)
            Route::get('sales/pricingmanagement', 'DiscountSettingsController@index')->name('.pricemanagement.index');
            Route::post('sales/pricingmanagement', 'DiscountSettingsController@store')->name('.pricemanagement.store');

            // Credit term Management
            Route::get('sales/term', 'TermController@index')->name('.term.index');

            Route::get('sales/term/create', 'TermController@create')->name('.term.create');
            Route::post('sales/term/store', 'TermController@store')->name('.term.store');
            Route::get('sales/getterms', 'TermController@getterms')->name('.term.getTerms');

            Route::get('sales/term/{term}/edit', 'TermController@edit')->name('.term.edit');
            Route::post('sales/term/{term}/update', 'TermController@update')->name('.term.update');
            Route::post('sales/term/{term}/delete', 'TermController@destroy')->name('.term.destroy');

            // customer management

            //  invite customer
            Route::get('sales/customermanagement/mycustomer/invitecustomer', 'InviteCustomerController@inviteCustomerIndex')->name('.customermanagement.mycustomer.invite.index');
            Route::post('sales/customermanagement/mycustomer/invitecustomer', 'InviteCustomerController@sendInvitation')->name('.customermanagement.mycustomer.invite.sendinvitation');

            //  customer invited
            Route::get('sales/customermanagement/mycustomer/customerinvited', 'InviteCustomerController@customerInvitedIndex')->name('.customermanagement.mycustomer.customerinvited');

            // new customer
            Route::get('sales/customermanagement/newcustomer', 'CustomerManagementController@newcustomerindex')->name('.customermanagement.newcustomerindex');
            Route::post('sales/customermanagement/newcustomerassign', 'CustomerManagementController@newcustomerassign')->name('.customermanagement.newcustomerassign');

            // reassign customer
            Route::get('sales/customermanagement/customerReassign', 'CustomerManagementController@customerReassign')->name('.customermanagement.mycustomer.customerReassign');
            Route::post('sales/customermanagement/customerReassign/reassign', 'CustomerManagementController@customerReassignStore')->name('.customermanagement.mycustomer.customerReassign.reassign');

            // my customer
            Route::get('sales/customermanagement/mycustomer', 'CustomerManagementController@mycustomerindex')->name('.customermanagement.mycustomer.index');
            Route::get('sales/customermanagement/mycustomer/details/{customer}', 'CustomerManagementController@mycustomerDetails')->name('.customermanagement.mycustomer.detials');
            Route::get('sales/customermanagement/mycustomer/manage/{customer}', 'CustomerManagementController@mycustomerManage')->name('.customermanagement.mycustomer.manage');
            Route::post('sales/customermanagement/mycustomer/manage/updateTerm', 'CustomerManagementController@updateTerm')->name('.customermanagement.mycustomer.updateTerm');
            // my customer - manage by category
            Route::get('sales/customermanagement/mycustomer/manageCategory/{customer}', 'CustomerManagementController@manageByCategory')->name('.customermanagement.mycustomer.managebycategory');
            Route::post('sales/customermanagement/mycustomer/manageCategory', 'CustomerManagementController@manageByCategoryStore')->name('.customermanagement.mycustomer.managebycategorystore');

            // get products datatable
            Route::get('sales/products/getproducts','CustomerManagementController@getproducts')->name('.sales.products.getproducts');
            // Route::get('sales/products/getproducts/product','CustomerManagementController@show')->name('.sales.product.getproducts.show');

            // my customer - manage by products
            Route::get('sales/customermanagement/mycustomer/manageProduct/{product}/{customerCompanyId}', 'CustomerManagementController@manageByProductEdit')->name('.customermanagement.mycustomer.manageByProduct.edit');
            // Route::get('sales/customermanagement/mycustomer/manage/{customer}', 'CustomerManagementController@mycustomerManage')->name('.customermanagement.mycustomer.manage');
            Route::post('sales/customermanagement/mycustomer/manageProduct/{product}', 'CustomerManagementController@manageByProductStore')->name('.customermanagement.mycustomer.managebyProduct.store');
            // Route::get('sales/customermanagement/mycustomer/manage/{product}', 'CustomerManagementController@manageByProductEdit')->name('.customermanagement.mycustomer.manageByProductUpdate');


            Route::post('sales/customermanagement/mycustomer/manage/{customer}', 'CustomerManagementController@mycustomerManageStore')->name('.customermanagement.mycustomer.manageStore');


            // Purchasing Center
            Route::get('purchasing/suppliermanagement/supplierinvitation', 'SupplierManagementController@supplierInvitation')->name('.suppliermanagement.supplierinvitation');
            Route::post('purchasing/suppliermanagement/supplierinvitation', 'SupplierManagementController@supplierJoinInvitation')->name('.suppliermanagement.supplierjoininvitation');
            Route::get('purchasing/suppliermanagement/mysupplier', 'SupplierManagementController@mySupplier')->name('.suppliermanagement.mysupplier');
            Route::get('purchasing/suppliermanagement/mysupplier/details/{supplier}', 'SupplierManagementController@mySupplierDetails')->name('.suppliermanagement.mysupplier.details');


        //});
    });

    Route::get('cart-view', 'CartController@index')->name('public.cart.view');
    Route::get('ajax/cart', 'CartController@ajaxcart')->name('public.cart.ajaxcart');
    Route::post('cart/update', 'CartController@update')->name('public.cart.update');
    Route::get('cart/remove/{company}/{product}', 'CartController@remove')->name('public.cart.remove');
    Route::get('cart-checkout', 'CartController@checkout')->name('public.cart.checkout');
    Route::put('cart-checkout/process', 'CartController@checkoutProcess')->name('public.cart.checkout.process');
    Route::post('add-to-cart', 'CartController@add')->name('public.cart.add');

    Route::get('wanted-list-view', 'WantedListController@index')->name('public.wantedlist.view');
    Route::post('add-to-wanted-list', 'WantedListController@add')->name('public.wantedlist.add');
    Route::get('wanted-list/remove/{wanted_list}/{product}', 'WantedListController@remove')->name('public.wantedlist.remove');
    Route::get('wanted-list/update/{wanted_list}/{quantity}', 'WantedListController@update')->name('public.wantedlist.update');
    Route::post('wanted-list/request', 'WantedListController@quotation_request')->name('public.wantedlist.request');

    Route::group(['middleware' => ['CheckCompanyRegistration']], function() {
		Route::get('addcompany', 'MainController@addcompany')->name('addcompany');
        Route::post('addcompany/purchaser/proccess', 'MainController@purchaseraddcompanypost')->name('purchaseraddcompanypost');
		Route::post('addcompany/proccess', 'MainController@addcompanypost')->name('addcompanypost');
        Route::get('check/initial', 'MainController@validatecompanypost')->name('validatecompanypost');
		Route::get('apply-to-seller', 'MainController@applyforseller')->name('apply.seller.company');
		Route::post('apply-to-seller/proccess', 'MainController@applyforsellerpost')->name('apply.seller.company.post');
		Route::get('upgrade-to-seller', 'MainController@upgradetoseller')->name('upgrade.seller.company');
		Route::post('upgrade-to-seller/{company}/update', 'MainController@upgradetosellerpost')->name('upgrade.seller.company.post');
	});

});
