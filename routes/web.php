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
Route::get('deletepinstatus/{id}', 'PinController@deletePin');
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
Route::post('reportperuser','HomeController@index');
Route::get('viewmap', 'TerritoryController@activeTerritory');
Route::get('deactivateTerritory/{id}', 'TerritoryController@deactivateTerritory');
Route::get('activateTerritory/{id}', 'TerritoryController@activateTerritory');
Route::get('/gotomap/{id}', 'HomeController@gotomap');
Route::post('reportperhour','HomeController@index');

Route::get('starttime', 'HourController@startTime');
Route::get('stoptime', 'HourController@stopTime');

Route::post('reportpertime', 'HomeController@index');
Route::post('/addpath', 'HomeController@addPath');
Route::get('/getpath/{id}', 'HomeController@getPath');
Route::post('/getpaths', 'HomeController@getPaths');