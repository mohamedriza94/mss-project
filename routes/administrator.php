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
            Route::get('/factory', 'HomeController@factory')->name('administrator.factory');
            Route::get('/department', 'HomeController@department')->name('administrator.department');
            Route::get('/supervisor', 'HomeController@supervisor')->name('administrator.supervisor');
            
            //factory CRUD routes
            Route::post('factory/create', 'FactoryController@create');
            Route::get('factory/read/{limit}', 'FactoryController@read');
            Route::get('factory/readOne/{id}', 'FactoryController@readOne');
            Route::get('factory/readRelation/{id}', 'FactoryController@readRelation');
            Route::delete('factory/delete/{id}', 'FactoryController@delete');
            Route::put('factory/update', 'FactoryController@update');

            //department CRUD routes
            Route::any('department/create', 'DepartmentController@create');
            Route::get('department/read/{limit}', 'DepartmentController@read');
            Route::get('department/readOne/{id}', 'DepartmentController@readOne');
            Route::delete('department/delete/{id}', 'DepartmentController@delete');
            Route::put('department/update', 'DepartmentController@update');

            //supervisor CRUD routes
            Route::post('supervisor/create', 'SupervisorController@create');
            Route::get('supervisor/read/{limit}', 'SupervisorController@read');
            Route::get('supervisor/readOne/{id}', 'SupervisorController@readOne');
            Route::delete('supervisor/delete/{id}', 'SupervisorController@delete');
            Route::post('supervisor/update', 'SupervisorController@update');
        });
    });
});