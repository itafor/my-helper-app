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

Route::get('reg_type', function() {
	return view('auth.select_registration_type');
})->name('selectReg');
Route::get('/corporate/register', function() {
	return view('auth.corporate_reg');
});

Auth::routes();

Route::get('/home', 'MakeRequestController@index')->name('home');
Auth::routes();
Route::get('getstates/{id}', 'AjaxController@getState');
Route::get('getcities/{id}', 'AjaxController@getCity');
Route::get('make/req/create', ['uses' => 'MakeRequestController@create', 'as' => 'make.request'])->middleware('guest');
Route::get('provide/req/create', ['uses' => 'ProvideRequestController@create', 'as' => 'provide.request'])->middleware('guest');
Route::get('checkemail', 'MakeRequestController@checkEmail');
Route::get('checkusername', 'MakeRequestController@checkUserName');
Route::get('view/{id}/request', ['uses' => 'ProvideRequestController@show', 'as' => 'view.request']);
Route::get('view/make/{id}/request', ['uses' => 'MakeRequestController@show', 'as' => 'view.make.request']);

Route::get('how-it-works', ['uses' => 'PagesController@how_it_works', 'as' => 'how_it_works']);

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('icons', ['as' => 'pages.icons', 'uses' => 'PageController@icons']);
	Route::get('maps', ['as' => 'pages.maps', 'uses' => 'PageController@maps']);
	Route::get('notifications', ['as' => 'pages.notifications', 'uses' => 'PageController@notifications']);
	Route::get('rtl', ['as' => 'pages.rtl', 'uses' => 'PageController@rtl']);
	Route::get('tables', ['as' => 'pages.tables', 'uses' => 'PageController@tables']);
	Route::get('typography', ['as' => 'pages.typography', 'uses' => 'PageController@typography']);
	Route::get('upgrade', ['as' => 'pages.upgrade', 'uses' => 'PageController@upgrade']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
	
	// Requests
	Route::get('requests', ['uses' => 'MakeRequestController@index', 'as' => 'requests']);
	Route::get('make/request', ['uses' => 'MakeRequestController@auth_create', 'as' => 'new.make.request']);
	Route::post('make/request', ['uses' => 'MakeRequestController@store', 'as' => 'store.make.request']);
	Route::get('show/{id}', ['uses' => 'MakeRequestController@show', 'as' => 'show.auth.request']);

	Route::get('provide/request', ['uses' => 'ProvideRequestController@auth_create', 'as' => 'new.provide.request']);
	Route::post('provide/request', ['uses' => 'ProvideRequestController@store', 'as' => 'store.provide.request']);
	Route::get('show/{id}/request', ['uses' => 'ProvideRequestController@show', 'as' => 'show.request']);
	Route::get('send/makerequest/{id}', ['uses' => 'MakeRequestController@sendMail', 'as' => 'send.requestDetails']);
	Route::get('send/providerequest/{id}', ['uses' => 'ProvideRequestController@sendMail', 'as' => 'send.provideDetails']);
});

