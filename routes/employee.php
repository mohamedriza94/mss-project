<?php
use Illuminate\Support\Facades\Route;
Route::group([
    'prefix'=>'employee', 
    'namespace'=>'App\Http\Controllers\Employee', 
    'middleware'=>['web']
], function(){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('employee.login');
    Route::post('/', 'Auth\LoginController@validateLogin')->name('employee.login.submit');
    Route::group(['middleware' => ['auth:employee']], function () {
        Route::post('/logout', 'Auth\LoginController@logout')->name('employee.logout');
        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', 'HomeController@index')->name('employee.dashboard');
        });
    });
});