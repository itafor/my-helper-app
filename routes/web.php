<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['uses' => 'LandingPageController@landing_page', 'as'=>'home.landingpage']);


Route::get('/corporate/register', 'LandingPageController@corporateRegistration');
Route::get('/reg_type', 'LandingPageController@registrationType')->name('selectReg');


Auth::routes();

Route::get('/home', 'MakeRequestController@index')->name('home');
Auth::routes();
Route::get('getstates/{id}', 'AjaxController@getState');
Route::get('getcities/{id}', 'AjaxController@getCity');
Route::get('apigetcities/{state}', 'AjaxController@fetch_cities_by_state');
Route::get('apigetdeliverytown/{citycode}', 'AjaxController@fetchOnforwardingOrDeliveryTowns');
Route::get('make/req/create', ['uses' => 'MakeRequestController@create', 'as' => 'make.request'])->middleware('guest');
Route::get('provide/req/create', ['uses' => 'ProvideRequestController@create', 'as' => 'provide.request'])->middleware('guest');
Route::get('checkemail', 'MakeRequestController@checkEmail');
Route::get('checkusername', 'MakeRequestController@checkUserName');
Route::get('view/{id}/request', ['uses' => 'ProvideRequestController@show', 'as' => 'view.request']);
Route::get('view/make/{id}/request', ['uses' => 'MakeRequestController@show', 'as' => 'view.make.request']);

Route::get('how-it-works', ['uses' => 'PagesController@how_it_works', 'as' => 'how_it_works']);

Route::get('all-requests', 'PagesController@all_requests')->name('all_requests');





Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::post('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	
	// Requests
	Route::get('requests', ['uses' => 'MakeRequestController@index', 'as' => 'requests']);
	Route::get('make/request', ['uses' => 'MakeRequestController@auth_create', 'as' => 'new.make.request']);
	Route::post('make/request', ['uses' => 'MakeRequestController@store', 'as' => 'store.make.request']);
	Route::get('show/{id}', ['uses' => 'MakeRequestController@show', 'as' => 'show.auth.request']);
	Route::get('auth_view/{id}/request', ['uses' => 'ProvideRequestController@auth_show', 'as' => 'auth_view.provide.request']);
	Route::get('auth_view/make/{id}/request', ['uses' => 'MakeRequestController@auth_show', 'as' => 'auth_view.make.request']);

	Route::get('provide/request', ['uses' => 'ProvideRequestController@auth_create', 'as' => 'new.provide.request']);
	Route::post('provide/request', ['uses' => 'ProvideRequestController@store', 'as' => 'store.provide.request']);
	Route::get('show/{id}/request', ['uses' => 'ProvideRequestController@show', 'as' => 'show.request']);
	Route::get('send/makerequest/{id}', ['uses' => 'MakeRequestController@sendMail', 'as' => 'send.requestDetails']);
	Route::get('send/providerequest/{id}', ['uses' => 'ProvideRequestController@sendMail', 'as' => 'send.provideDetails']);

	Route::group([
    'prefix' => 'user'
], function () {
    Route::get('/requests', 'UserController@user_requests')->name('user.request');
    Route::get('/product/services', 'UserController@product_services')->name('user.product.services');
});

Route::group([
    'prefix' => 'request'
], function () {
    Route::post('/apply', 'RequestBiddersController@applyTOGetHelp')->name('request.apply');
    Route::post('/provide', 'RequestBiddersController@grantSomeoneRequest')->name('request.provide');

    Route::get('/approve/{id}', 'RequestBiddersController@initialRequestApprovalForhelpSeekers')->name('request.approve');

    Route::get('/reject/{id}', 'UtilitiesController@rejectRequest')->name('request.reject');

 Route::post('/approve', 'RequestBiddersController@finalRequestApprovalForhelpSeekers')->name('request.approve.store');

 Route::get('/approve_or_reject_request/{id}', 'RequestBiddersController@initialRequestApprovalByHelpReceiver')->name('request.approve_or_reject');

 Route::post('/approve_or_reject_request_store', 'RequestBiddersController@finalRequestApprovalByHelpReceiver')->name('request.approve_or_reject.store');

 Route::post('/reject_request_by_receiver', 'RequestBiddersController@rejectRequestByReceiver')->name('request.reject.by.receiver');
});
	
});

Route::group([
	'middleware' => ['auth','admin'],
    'prefix' => 'admin'
], function () {
    Route::get('/profile', 'AdminController@profile')->name('admin.profile');
    Route::get('/dashboard', 'AdminController@dashboard')->name('admin.dashboard');
    Route::get('/logistic', 'AdminController@logisticEgents')->name('admin.logistic.agent');
    Route::get('/add_new_logistic_agent', 'AdminController@add_new_logistic_agent')->name('admin.logistic.agent.add');
    // Route::get('edit_logistic/{id}', 'AdminController@edit_logistic')->name('admin.logistic.agent.edit');
    // Route::post('/update_logistic/', 'AdminController@update_logistic')->name('admin.logistic.agent.update');

    Route::post('/store_logistic', 'AdminController@storeLogisticEgent')->name('admin.logistic.agent.store');
    Route::get('/{item}/{id}', 'UtilitiesController@destroyItem')->name('admin.del_items');

     Route::get('/track_shipment', 'AdminController@showShipmentTrackingForm')->name('admin.pickupRequest.shipmenttracker');

     Route::post('/track/shipment', 'AdminController@trackShipment')->name('admin.pickupRequest.trackshipment.store');
});

Route::group([
	'middleware' => ['auth','admin'],
], function () {
    Route::get('admin_edit_logistic/{id}', 'AdminController@edit_logistic')->name('admin.logistic.agent.edit');
    Route::post('/update_logistic', 'AdminController@update_logistic')->name('admin.logistic.agent.update');
    Route::get('show_logistic_agent_details/{id}', 'AdminController@show_logistic')->name('admin.logistic.agent.show');

    Route::get('all_requests', 'AdminController@allRequest')->name('admin.all.requests');

    Route::get('request_details/{id}', 'AdminController@provideHelprequestDetails')->name('admin.request.show');

    Route::get('/request_summary/{id}', 'AdminController@provide_helprequest_summary')->name('request.summary');

     Route::get('get_help_request_details/{id}', 'AdminController@getHelprequestDetails')->name('admin.get.request.show');

    Route::get('/get_help_request_summary/{id}', 'AdminController@get_helprequest_summary')->name('admin.get.request.summary');

});

Route::group([
	'middleware' => ['auth','admin'],
], function () {
    Route::get('admin/products', 'ProductsController@index')->name('admin.product.index');
    Route::get('show_Item_detail/{id}', 'ProductsController@showItemDetail')->name('show.item.category.detail');

    Route::get('/admin/add_new_product', 'ProductsController@create')->name('admin.product.create');
    Route::post('/store_product', 'ProductsController@storeLogisticEgent')->name('admin.product.store');
    Route::get('/add_new_item_subcategory', 'ProductsController@createItemSubCategory')->name('admin.item.subcategory.create');
    Route::post('/store_Item_Subcategory', 'ProductsController@storeItemSubcategory')->name('admin.item.Subcategory.store');
    Route::get('items_subcategoies', 'ProductsController@itemSubcategories')->name('admin.view.item.subcategory');

});

Route::group([
    'middleware' => ['auth','logistic_partner'],
], function () {
    Route::get('logistic_partner/profile', 'LogisticPartnerController@profile')->name('logistic_partner.profile');
    Route::get('logistic_partner/dashboard', 'LogisticPartnerController@dashboard')->name('logistic_partner.dashboard');

    Route::get('logistic_partner/requests', 'LogisticPartnerController@requests')->name('logistic_partner.requests');

    Route::get('logistic_partner_requests/{id}', 'LogisticPartnerController@initialRequestConfirmationByLogisticPartner')->name('logistic_partner.request.initialconfirmation');

    Route::post('logistic_partner_requests', 'LogisticPartnerController@finalRequestConfirmationByLogisticPartner')->name('logistic_partner.request.finalconfirmation');
});

	Route::group([
    'prefix' => 'product'
], function () {
    Route::get('/services', 'ProductsController@product_services')->name('product.services');
});

 Route::group([
    'prefix' => 'pickupRequest'
], function () {
    Route::get('/store', 'UtilitiesController@submittingPickupRequestInformationandGeneratingWaybillNumber')->name('pickupRequest.store');

     Route::get('/print/waybill', 'UtilitiesController@printWaybill')->name('pickupRequest.printwaybill');

     Route::get('/details/{request_id}/{provider_id}/{receiver_id}', 'UtilitiesController@pickupRequestDetail')->name('pickupRequest.details');

     Route::get('/track_shipment', 'PickupRequestController@showShipmentTrackingForm')->name('pickupRequest.shipmenttracker');

     Route::post('/track/shipment', 'PickupRequestController@trackShipment')->name('pickupRequest.trackshipment.store');

    Route::get('/calculate/deliveryfee', 'PickupRequestController@calculateDeliveryFeeForm')->name('pickupRequest.calculate.deliveryfee');
    
    Route::post('/calculate_deliveryfee', 'PickupRequestController@calculateDeliveryFeeOperation')->name('pickupRequest.calculate.deliveryfeeOperation');

     Route::get('/approve/{id}', 'MakeRequestController@initialRequestApprovalForhelpSeekers')->name('pickupRequest.approve');

 Route::post('/approve', 'MakeRequestController@finalRequestApprovalForhelpSeekers')->name('pickupRequest.approve.store');

  Route::post('/shipping_fee_payment', 'PickupRequestController@payWithPayStack')->name('initiate_shipping_fee_payment');

  Route::get('/payment-status', 'PickupRequestController@getPaymentStatus')->name('check.payment.status.form');
  Route::post('/check-payment-status', 'PickupRequestController@checkPaymentStatus')->name('check.payment.status');

});



