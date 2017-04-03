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
    return redirect('/admin-dashboard');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/showLogin', ['uses'=>'AdminController@showLogin'])->name('test.showLogin');
Route::get('/showRegistration', ['uses'=>'AdminController@showRegistration'])->name('test.showRegistration');
Route::get('/showForgotPassword', ['uses'=>'AdminController@showForgotPassword'])->name('test.showForgotPassword');





//If roles == 1
Route::group(['middleware'=>['auth', 'checkRole:1']], function(){

	Route::get('/showApproval', ['uses'=>'AdminController@showApproval'])->name('admin.showApproval');
	Route::patch('/updateZakatStatus', ['uses'=>'ZakatController@updateZakatStatus'])->name('zakat.updateZakatStatus');

	Route::get('/banks', ['uses'=>'BankController@index'])->name('bank.index');
	Route::delete('/banks/delete', ['uses'=>'BankController@deleteBank'])->name('bank.delete');
	Route::post('/banks/create', ['uses'=>'BankController@createBank'])->name('bank.create');

	Route::get('/admin-management', ['uses'=>'AdminController@adminManagement'])->name('admin.management');
	Route::delete('/admin-management/delete', ['uses'=>'AdminController@adminDelete'])->name('admin.delete');
	Route::post('/admin-management/create', ['uses'=>'AdminController@adminCreate'])->name('admin.create');
	Route::patch('/admin-management/edit', ['uses'=>'AdminController@adminEdit'])->name('admin.edit');
	Route::get('/admin-dashboard', ['uses'=>'AdminController@dashboard'])->name('admin.dashboard');


});


//If roles == 1 OR 2
Route::group(['middleware'=>['auth', 'checkRole:1|2']], function(){

	Route::resource('/user', 'UserController');
	Route::post('/insertZakat', ['uses'=>'ZakatController@insertZakat'])->name('zakat.insertZakat');
	

});


