<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'administrator', 
    'namespace'=>'App\Http\Controllers\Administrator', 
    'middleware'=>['web']
], function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('administrator.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('administrator.login.submit');
    Route::group(['middleware' => ['auth:administrator']], function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('administrator.logout');
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'HomeController@index')->name('administrator.dashboard');
        });
    });
});