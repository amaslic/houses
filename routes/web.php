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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('registers', 'RegisterUsers@registers');
Route::post('registeruser', 'RegisterUsers@register');
Route::get('logout', 'HomeController@logout');
Route::get('userlist', 'HomeController@userlist');
Route::get('pins', 'HomeController@pins');
Route::post('addpin', 'PinController@addPin');
Route::get('pins', 'PinController@getPin');
Route::get('addteritory', 'TerritoryController@userslist');
Route::post('createTerritory', 'TerritoryController@createTerritory');
Route::get('territoryByUser/{id}', 'TerritoryController@territoryByUser');
Route::get('viewmap', 'HomeController@viewmap');
Route::get('viewusermap', 'HomeController@viewusermap');
Route::post('addmarker', 'MarkerController@addmarker');
Route::get('editpin/{id}','MarkerController@editpin');
Route::post('editmarker/{id}','MarkerController@editmarker');
Route::get('makesale/{id}', 'SaleController@makesale');
Route::post('submitsale/{id}', 'SaleController@submitsale');
Route::get('deletepin/{id}','MarkerController@deletemarker');