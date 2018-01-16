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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::post('/logout','auth\LoginController@logout')->name('logout');
Route::prefix('admin')->group(function(){
	Route::get('/','AdminController@index')->name('admin.dashboard');
	Route::get('/logi','auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','auth\AdminLoginController@login')->name('admin.login.submit');
	Route::post('/logout','auth\AdminLoginController@logout')->name('admin.logout');
});

/*======== Product create,update and delete route ========*/
Route::prefix('product')->group(function(){
	Route::get('/','ProductsController@index')->name('product.view');
	Route::get('/create','ProductsController@createProductView')->name('product.create.view');
	Route::post('/create','ProductsController@createProduct')->name('product.create.submit');
	Route::post('/delete','ProductsController@productDelete')->name('product.delete');
	Route::get('/edit','ProductsController@editProduct')->name('product.edit');
	Route::post('/update','ProductsController@updateProduct')->name('product.update.submit');
});
/*======== Product create,update and delete route ========*/