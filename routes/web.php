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
Route::get('/401','ErrorHandlerController@errorCode401')->name('401');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/config','ArtisanController@config');
Route::redirect('/','/floors');
Route::view('/admin','admin.dashboard')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/platform','Admin\\PlatformController@postRequest');
Route::get('/platform/{floor}/{switch}/{status}','Admin\\PlatformController@callMechanic');

Route::get("admin/{id}/floorDetails","Admin\\FloorsController@FloorDetails")->name('floorDetails');
Route::get('admin/machines/setSwitch/{floor_id}/{switch}','Admin\\MachinesController@setMachineView');
Route::patch('admin/machines/setMachine/{floor_id}/{switch}','Admin\\MachinesController@setMachine')->name('setMachine');
Route::post('admin/machines/getMachines','Admin\\MachinesController@getMachineFromMachineSub');
Route::get('/floors','FrontController@index');//Will SHOW THE PAGE WITH MACHINES WHERE THE VIEW OF SIGNAL GOES

Route::get('/production/{floor}/{line}','ProductionController@index');
Route::get('/production/{floor}/{line}/{type}/count','ProductionController@countget');
Route::post('/production/count','ProductionController@countpost');
Route::get('/production/countHourly','ProductionController@countHourly');
Route::post('/production/countHourly','ProductionController@countHourlyPost');

Route::post('/machine/status','FrontController@machineStatus');
Route::post('/machine/status/updateCheck','FrontController@checked');//checking whether checked of not after changing the view
Route::get('/machine/status/{room}/{switch}','FrontController@test');

Route::get("/test/{id}","Admin\\MachinesController@testing");


Route::middleware(['auth'])->group(function(){
    Route::prefix('/admin')->group(function () {
        Route::resource('/roles','RoleController')->middleware('RoleMiddleware');
        Route::get('/profile','ProfileController@AdminProfile');
        Route::PATCH('/profile/{user_id}','ProfileController@UpdateAdminProfile');
        Route::PATCH('/profile/{user_id}/password','ProfileController@VendorPassword');
        Route::resource('/floors', 'Admin\\FloorsController');
        Route::resource('/controllers', 'Admin\\MControllersController');
        Route::resource('/machines', 'Admin\\MachinesController');
        Route::get('/machineDetails/{id}','Admin\\MachinesController@machineDetails');
//	Route::resource('/machines/{floor_id}/{switch}', 'Admin\\MachinesController@setMachine');
        Route::resource('/machine-category', 'Admin\\MachineCategoryController');
        Route::resource('/store', 'Admin\\StoreController',['except' => [
            'edit', 'update', 'destroy'
        ]]);


        Route::post('/store/getAllMachinePartsFromMachineCat', 'Admin\\StoreController@getAllMachinePartsFromMachineCat');
        Route::get('/store/parts/{id}', 'Admin\\StoreController@test');
        Route::resource('/request-platform', 'Admin\\RequestPlatformController')->middleware('RequestPlatformMiddleware');//store will create request for parts
        Route::resource('/request-platform/general-store', 'Admin\\RequestPlatformController@generalStoreCreate');//store will create request for parts
        Route::post('/request-platform/fetchMachineFromCat', 'Admin\\RequestPlatformController@fetchMachineFromCat');//store will create request for parts
        Route::post('/request-platform/deliver', 'Admin\\RequestPlatformController@deliver')->name('deliver');//store will create request for parts
        Route::post('/request-platform/approve', 'Admin\\RequestPlatformController@approve')->name('approve');//store will create request for parts
        Route::post('/general-stores/getAccessoriess', 'Admin\\GeneralStoreController@getAccessories');
        Route::resource('/targets', 'Admin\\TargetsController')->middleware('TargetMiddleware');
        Route::resource('/parts', 'Admin\\PartsController')->middleware('PartsMiddleware');
        Route::resource('/users', 'Admin\\UsersController');
        Route::resource('/permission','Admin\\PermissionController');
        Route::get('/machine-history','Admin\\HistoryController@index')->middleware('HistoryMiddleware');
        Route::post('/machine-history','Admin\\HistoryController@SortPlatform')->name('HistoryController.SortPlatform')->middleware('HistoryMiddleware');
        Route::resource('/buyers', 'Admin\\BuyersController')->middleware('BuyerMiddleware');
        Route::resource('/orders', 'Admin\\OrdersController')->middleware('OrderMiddleware');
        Route::resource('/general-store', 'Admin\\GeneralStoreController')->middleware('GeneralStoreMiddleware');
        Route::post('/general-store/{id}', 'Admin\\GeneralStoreController@deliver');
        Route::get('/production', 'ProductionController@show');
        Route::post('/production', 'ProductionController@SortProduction')->name('production.SortProduction');


        Route::middleware('AccessoriesMiddleware')->group(function(){
            Route::resource('/accessorieses', 'Admin\\AccessoriesesController')->only('store');
            Route::get('/accessorieses/{order}/order','Admin\\AccessoriesesController@index')->name('accessorieses.index');
            Route::get('/accessorieses/order/{order}/create','Admin\\AccessoriesesController@create');
            Route::get('/accessorieses/order/{order}/acs/{acsries}/edit','Admin\\AccessoriesesController@edit');
            Route::get('/accessorieses/order/{order}/acs/{acsries}/show','Admin\\AccessoriesesController@show');
            Route::patch('/accessorieses/order/acs/update/{order}/{acsries}','Admin\\AccessoriesesController@update');
            Route::delete('/accessorieses/order/acs/destroy/{order}/{acsries}','Admin\\AccessoriesesController@destroy');
            Route::post('/accessorieses/order/{order}/store','Admin\\AccessoriesesController@store')->name('order.accessories');
            Route::get('/accessorieses/{accessoriese_id}/order/{orderId}/store','Admin\\AccessoriesesController@acsplatform');//store accessories platform
            Route::post('/accessorieses/storeAccessorieses/{accessoriese_id}','Admin\\AccessoriesesController@storeacsplatform');//store accessories platform
        });

    });

    Route::get("/test/{id}","Admin\\RequestPlatformController@test");

});

