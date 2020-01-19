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
    return redirect('login');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('loginpage');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('registerpage');
Route::post('register', 'Auth\RegisterController@register')->name('register');

Route::group(['middleware' => ['auth']], function () {

    Route::get('dashboard', 'DashboardController@index')->name('dashboard');

    Route::post('logout', 'Auth\LoginController@logout')->name('logout'); 
    Route::get('/permission-denied', 'DashboardController@permissionDenied')->name('permission-denied');   

    Route::group(['middleware' => ['admin']], function(){
        Route::resource('soil', 'SoilController');
        Route::resource('region', 'RegionController');        
        Route::resource('action', 'ActionController');
        Route::resource('sensor', 'SensorController');
        Route::resource('actuator', 'ActuatorController');
        Route::resource('controller', 'MyControllersController');        
        Route::resource('category', 'CategoryController');
        Route::resource('type', 'TypeController');
        Route::resource('unit', 'UnitController');
        Route::resource('plant', 'PlantController');
        Route::resource('area', 'AreaController');
        Route::resource('area-capacity', 'AreaCapacityController');
        Route::resource('packet', 'PacketController');
        Route::resource('packet-kit', 'PacketKitController');
        
        Route::resource('project-area-kit', 'ProjectAreaKitController');        

        Route::get('control-data', 'AjaxController@controlData')->name('controlData');
        Route::get('get-packet-kit-count', 'AjaxController@getPacketKitCount')->name('getPacketKitCount');
        Route::get('get-packet-kit-inputs', 'AjaxController@getPacketKitInputs')->name('getPacketKitInputs');
        Route::get('get-mac-count', 'AjaxController@getMacCount')->name('getMacCount');
                
    });

    Route::resource('input', 'InputController');
    Route::resource('kit', 'KitController');

    Route::get('project/before-create', 'ProjectController@beforeCreate')->name('project.before-create');
    // Route::post('project/calculate-budget', 'ProjectController@calculateBudget')->name('project.calculate-budget');
    Route::resource('project', 'ProjectController');

    Route::resource('project-area', 'ProjectAreaController');

    Route::get('region-soils', 'AjaxController@getRegionSoils')->name('getRegionSoils');
    Route::get('soil-plants', 'AjaxController@getSoilPlants')->name('getSoilPlants');
    Route::get('areas', 'AjaxController@getAreas')->name('getAreas');
    Route::get('packets', 'AjaxController@getPackets')->name('getPackets');
});
