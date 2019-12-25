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

Route::get('dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('loginpage');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');



// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('registerpage');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::group(['middleware' => ['auth']], function () {

Route::post('logout', 'Auth\LoginController@logout')->name('logout');    

Route::resource('soil', 'SoilController');
Route::resource('region', 'RegionController');
Route::resource('input', 'InputController');
Route::resource('action', 'ActionController');
Route::resource('sensor', 'SensorController');
Route::resource('actuator', 'ActuatorController');
Route::resource('controller', 'MyControllersController');
Route::resource('kit', 'KitController');
Route::resource('category', 'CategoryController');
Route::resource('type', 'TypeController');
Route::resource('unit', 'UnitController');
Route::resource('plant', 'PlantController');
Route::resource('area', 'AreaController');
Route::resource('area-capacity', 'AreaCapacityController');
Route::resource('packet', 'PacketController');

Route::get('region-soils', 'AjaxController@getRegionSoils')->name('getRegionSoils');
Route::get('soil-plants', 'AjaxController@getSoilPlants')->name('getSoilPlants');
Route::get('areas', 'AjaxController@getAreas')->name('getAreas');

Route::get('control-data', 'AjaxController@controlData')->name('controlData');
});