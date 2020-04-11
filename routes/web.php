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

Route::get('/', function () {
    return view('welcome');
});

Route::get('reg_type', function() {
	return view('auth.select_registration_type');
})->name('selectReg');
Route::get('/corporate/register', function() {
	return view('auth.corporate_reg');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('getstates/{id}', 'AjaxController@getState');
Route::get('getcities/{id}', 'AjaxController@getCity');

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
	Route::get('make/request', ['uses' => 'MakeRequestController@create', 'as' => 'make.request']);
	Route::post('make/request', ['uses' => 'MakeRequestController@store', 'as' => 'store.make.request']);

	Route::get('provide/request', ['uses' => 'ProvideRequestController@create', 'as' => 'provide.request']);
});

