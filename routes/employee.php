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
            Route::get('/workshop', 'HomeController@workshop')->name('employee.workshop');
            Route::get('/kanbanCard', 'HomeController@kanbanCard')->name('employee.kanbanCard');
            Route::get('/worker', 'HomeController@worker')->name('employee.worker');
            Route::get('/inventory', 'HomeController@inventory')->name('employee.inventory');

            //workshop CRUD routes
            Route::any('workshop/create', 'WorkshopController@create');
            Route::get('workshop/read/{limit}', 'WorkshopController@read');
            Route::get('workshop/readSlot/{workshopNo}/{limit_arrow}', 'WorkshopController@readSlot');
            Route::get('workshop/readOne/{workshopNo}', 'WorkshopController@readOne');
            Route::delete('workshop/delete/{no}', 'WorkshopController@delete');
            Route::delete('workshop/deleteSlot/{id}', 'WorkshopController@deleteSlot');
            Route::put('workshop/updateStatus/{id}/{status}', 'WorkshopController@updateStatus');
            Route::put('workshop/update', 'WorkshopController@update');

            //worker CRUD routes
            Route::post('worker/create', 'EmployeeController@create');
            Route::get('worker/read/{limit}', 'EmployeeController@read');
            Route::get('worker/readOne/{id}', 'EmployeeController@readOne');
            Route::delete('worker/delete/{id}', 'EmployeeController@delete');
            Route::post('worker/update', 'EmployeeController@update');
            Route::get('department/readRelation/{departmentNo}', 'EmployeeController@readRelation');
            Route::get('workshop/readToSelect', 'WorkshopController@readToSelect');

            //raw material CRUD
            Route::post('rm/create', 'RawMaterialController@create');
            Route::get('rm/read/{limit}', 'RawMaterialController@read');
            Route::get('rm/readOne/{id}', 'RawMaterialController@readOne');
            Route::delete('rm/delete/{id}', 'RawMaterialController@delete');
            Route::post('rm/update', 'RawMaterialController@update');
            Route::post('rm/addQuantity', 'RawMaterialController@addQuantity');
            Route::get('rm/readWarehouseInventory', 'RawMaterialController@readWarehouseInventory');
            Route::get('rm/readInventoryRequest/{inventoryNo}/{limit_arrow}', 'RawMaterialController@readInventoryRequest');

            //card CRUD
            Route::post('kbc/create', 'KanbanCardController@create');
            Route::get('kbc/read/{limit}', 'KanbanCardController@read');
            Route::get('kbc/readOne/{no}', 'KanbanCardController@readOne');
            Route::delete('kbc/delete/{no}', 'KanbanCardController@delete');
            Route::post('kbc/update', 'KanbanCardController@update');

            //task CRUD
            Route::post('task/create', 'KanbanCardController@createTask');
            Route::get('task/read/{cardNo}/{limit_arrow}', 'KanbanCardController@readTask');
            Route::get('task/readOne/{no}', 'KanbanCardController@readOneTask');
            Route::get('task/autoSchedule', 'KanbanCardController@autoSchedule');
            Route::post('task/update', 'KanbanCardController@updateTask');
            Route::delete('task/delete/{no}', 'KanbanCardController@deleteTask');

            //worker Task update
            Route::get('workerDash/readForTaskOptions', 'RawMaterialController@readForTaskOptions');
            Route::get('workerDash/getWorkerTask', 'KanbanCardController@getWorkerTask');
            Route::post('workerDash/useRawMaterial', 'KanbanCardController@useRawMaterial');
            Route::get('workerDash/readUsedRawMaterial/{taskNo}', 'KanbanCardController@readUsedRawMaterial');
            Route::post('workerDash/startTask', 'KanbanCardController@startTask');
            Route::post('workerDash/endTask', 'KanbanCardController@endTask');

            //statistics
            Route::get('counts', 'HomeController@counts');
            Route::get('IR/{limit}/{type}', 'HomeController@IR');
            Route::get('AI/{limit}/{type}', 'HomeController@AI');
            Route::get('WI/{limit}/{type}', 'HomeController@WI');
            Route::get('T/{limit}/{type}/{status}', 'HomeController@T');
            Route::get('KBC/{limit}/{type}/{status}', 'HomeController@KBC');
            Route::get('S/{limit}/{type}/{status}', 'HomeController@S');
        });
    });
});