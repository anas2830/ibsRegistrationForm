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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getDivisionHome', 'HomeController@getDivisionHome')->name('getDivisionHome');
Route::get('/getDistrictHome', 'HomeController@getDistrictHome')->name('getDistrictHome');
Route::get('/userDataAjax', 'HomeController@userDataAjax')->name('userDataAjax');

//register
Route::get('/getDivision', 'Auth\RegisterController@getDivision')->name('getDivision');
Route::get('/getDistrict', 'Auth\RegisterController@getDistrict')->name('getDistrict');



Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/sign-up', 'Auth\RegisterController@signUp')->name('sign-up');
