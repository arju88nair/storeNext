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

Route::get('/register','HomeController@index');


Route::post('/formRegister','HomeController@formRegister');

Route::get('/adminView','HomeController@adminView');

Route::get('/getUserDetails','HomeController@getUserDetails');

Route::get('/updateUser','HomeController@updateUser');

Route::post('/login','HomeController@login');

Route::get('/','HomeController@home');

Route::get('/submitProduct','HomeController@submitProduct');

Route::get('/couponSubmit','HomeController@couponSubmit');

Route::get('/logout','HomeController@logout');

Route::get('/loadmore','HomeController@loadmore');

Route::get('/search','HomeController@search');

Route::get('/getProfile','HomeController@getProfile');

Route::get('/updateProfile','HomeController@updateProfile');

Route::get('/checkout','HomeController@checkout');

Route::get('/{product_name}/product_details/{id}','HomeController@details');
