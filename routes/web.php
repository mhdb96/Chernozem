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
