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
Route::get('registers', 'RegisterUsers@registers');
Route::post('registeruser', 'RegisterUsers@register');
Route::get('logout', 'HomeController@logout');
Route::get('userlist', 'HomeController@userlist');
Route::get('pins', 'HomeController@pins');
Route::get('addteritory', 'TerritoryController@userslist');
Route::get('viewmap', 'HomeController@viewmap');
Route::get('viewusermap', 'HomeController@viewusermap');