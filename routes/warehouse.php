<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'warehouse', 
    'namespace'=>'App\Http\Controllers\Warehouse', 
    'middleware'=>['web']
], function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('warehouse.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('warehouse.login.submit');
    Route::group(['middleware' => ['auth:warehouse']], function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('warehouse.logout');
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'HomeController@index')->name('warehouse.dashboard');
            Route::get('/inventory', 'HomeController@inventory')->name('warehouse.inventory');

            //inventory CRUD routes
            Route::any('/addInventory', 'HomeController@create')->name('warehouse.addInventory');
            Route::get('/read/{limit}', 'HomeController@read');
            Route::get('/readOne/{id}', 'HomeController@readOne');
            Route::delete('/delete/{id}', 'HomeController@delete');
            Route::put('/update', 'HomeController@update');
            Route::put('/addQuantity', 'HomeController@addQuantity');
        });
    });
});