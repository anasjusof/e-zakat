<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/showLogin', ['uses'=>'AdminController@showLogin'])->name('test.showLogin');
Route::get('/showRegistration', ['uses'=>'AdminController@showRegistration'])->name('test.showRegistration');
Route::get('/showForgotPassword', ['uses'=>'AdminController@showForgotPassword'])->name('test.showForgotPassword');

Route::post('/insertZakat', ['uses'=>'ZakatController@insertZakat'])->name('zakat.insertZakat');



//If roles == 1
Route::group(['middleware'=>['auth', 'checkRole:1']], function(){

	Route::get('/showApproval', ['uses'=>'AdminController@showApproval'])->name('admin.showApproval');

});


//If roles == 1 OR 2
Route::group(['middleware'=>['auth', 'checkRole:1|2']], function(){

	Route::resource('/user', 'UserController');
	

});


