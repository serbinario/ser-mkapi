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


Auth::routes();

Route::get('/', 'RouterController@index')
    ->name('router.router.index');

//Route::get('/home', 'HomeController@index')->name('home');

//Url para receber reuqest do boletofacil
Route::any('/notificationUrl', 'NotificationUrl@notificationUrl')->name('notificationUrl');

//RN-0001
Route::get('/cobrancasAPI', 'CobrancasAPIController@gerenciant')->name('cobrancasAPI.gerencianet');

Route::any('/cobrancasAPISend', 'CobrancasAPIController@cobrancasAPISend')->name('cobrancasAPI.cobrancasAPISend');

//RN-0002
Route::any('/cobrancasAPIMsg', 'CobrancasAPIController@cobrancasAPIMsg')->name('cobrancasAPI.cobrancasAPIMsg');
Route::any('/cobrancasAPIMsgBoleto', 'CobrancasAPIController@cobrancasAPIMsgBoleto')->name('cobrancasAPI.cobrancasAPIMsgBoleto');
Route::any('/cobrancasPendentes', 'CobrancasAPIController@cobrancasPendentes')->name('cobrancasAPI.cobrancasPendentes');





//Route::any('/enableDisableSecret', 'NotificationUrl@notificationUrl')->name('notificationUrl');



Route::group(
    [
        'prefix' => 'mikrotik',
    ], function () {

    Route::POST('/enableDisableSecret/{id}', 'MikrotikController@enableDisableSecret')
        ->name('mikrotik.enableDisableSecret');

    Route::get('/clientesPorMes','MikrotikController@clientesPorMes')
        ->name('mikrotik.clientesPorMes');


});
Route::group(
    [
        'prefix' => 'inadimplente',
    ], function () {

    Route::get('/grid', 'DebitosController@inadimplentes')
        ->name('inadimplentes.index');
    Route::get('/', 'DebitosController@inadimplentesIndex')
        ->name('inadimplentes.index');


});

Route::group(
    [
        'prefix' => 'paidDay',
    ], function () {

    Route::get('/grid', 'DebitosController@paidDay')
        ->name('paidDay.grid');
    Route::get('/', 'DebitosController@paidDayIndex')
        ->name('paidDay.index');


});


Route::group(
    [
        'prefix' => 'dashboard',
    ], function () {

    Route::get('/', 'Dashboard@index')
        ->name('dashboard.index');

    Route::get('/clientesPorMes','Dashboard@clientesPorMes')
        ->name('dashboard.clientesPorMes');

    Route::get('/grid', 'RouterController@grid')
        ->name('dashboard.router.grid');


});

Route::group(
[
    'prefix' => 'router',
], function () {

    Route::get('/', 'RouterController@index')
         ->name('router.router.index');

    Route::get('/create','RouterController@create')
         ->name('router.router.create');

    Route::get('/grid', 'RouterController@grid')
         ->name('router.router.grid');

    Route::get('/show/{router}','RouterController@show')
         ->name('router.router.show')
         ->where('id', '[0-9]+');

    Route::get('/{router}/edit','RouterController@edit')
         ->name('router.router.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RouterController@store')
         ->name('router.router.store');
               
    Route::put('router/{router}', 'RouterController@update')
         ->name('router.router.update')
         ->where('id', '[0-9]+');

    Route::delete('/{router}/destroy','RouterController@destroy')
         ->name('router.router.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'profile',
], function () {

    Route::get('/', 'ProfileController@index')
         ->name('profile.profile.index');

    Route::get('/create','ProfileController@create')
         ->name('profile.profile.create');

    Route::get('/grid', 'ProfileController@grid')
         ->name('profile.profile.grid');

    Route::get('/show/{profile}','ProfileController@show')
         ->name('profile.profile.show')
         ->where('id', '[0-9]+');

    Route::get('/{profile}/edit','ProfileController@edit')
         ->name('profile.profile.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProfileController@store')
         ->name('profile.profile.store');
               
    Route::put('profile/{profile}', 'ProfileController@update')
         ->name('profile.profile.update')
         ->where('id', '[0-9]+');

    Route::delete('/{profile}/destroy','ProfileController@destroy')
         ->name('profile.profile.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'pool',
], function () {

    Route::get('/', 'PoolController@index')
         ->name('pool.pool.index');

    Route::get('/create','PoolController@create')
         ->name('pool.pool.create');

    Route::get('/grid', 'PoolController@grid')
         ->name('pool.pool.grid');

    Route::get('/show/{pool}','PoolController@show')
         ->name('pool.pool.show')
         ->where('id', '[0-9]+');

    Route::get('/{pool}/edit','PoolController@edit')
         ->name('pool.pool.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PoolController@store')
         ->name('pool.pool.store');
               
    Route::put('pool/{pool}', 'PoolController@update')
         ->name('pool.pool.update')
         ->where('id', '[0-9]+');

    Route::delete('/{pool}/destroy','PoolController@destroy')
         ->name('pool.pool.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'router',
], function () {

    Route::get('/', 'RouterController@index')
         ->name('router.router.index');

    Route::get('/create','RouterController@create')
         ->name('router.router.create');

    Route::get('/grid', 'RouterController@grid')
         ->name('router.router.grid');

    Route::get('/show/{router}','RouterController@show')
         ->name('router.router.show')
         ->where('id', '[0-9]+');

    Route::get('/{router}/edit','RouterController@edit')
         ->name('router.router.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'RouterController@store')
         ->name('router.router.store');
               
    Route::put('router/{router}', 'RouterController@update')
         ->name('router.router.update')
         ->where('id', '[0-9]+');

    Route::delete('/{router}/destroy','RouterController@destroy')
         ->name('router.router.destroy')
         ->where('id', '[0-9]+');

});




Route::group(
[
    'prefix' => 'profile',
], function () {

    Route::get('/', 'ProfileController@index')
         ->name('profile.profile.index');

    Route::get('/create','ProfileController@create')
         ->name('profile.profile.create');

    Route::get('/grid', 'ProfileController@grid')
         ->name('profile.profile.grid');

    Route::get('/show/{profile}','ProfileController@show')
         ->name('profile.profile.show')
         ->where('id', '[0-9]+');

    Route::get('/{profile}/edit','ProfileController@edit')
         ->name('profile.profile.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ProfileController@store')
         ->name('profile.profile.store');
               
    Route::put('profile/{profile}', 'ProfileController@update')
         ->name('profile.profile.update')
         ->where('id', '[0-9]+');

    Route::delete('/{profile}/destroy','ProfileController@destroy')
         ->name('profile.profile.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'test',
], function () {

    Route::get('/', 'TestController@index')
         ->name('test.test.index');

    Route::get('/create','TestController@create')
         ->name('test.test.create');

    Route::get('/grid', 'TestController@grid')
         ->name('test.test.grid');

    Route::get('/show/{test}','TestController@show')
         ->name('test.test.show')
         ->where('id', '[0-9]+');

    Route::get('/{test}/edit','TestController@edit')
         ->name('test.test.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'TestController@store')
         ->name('test.test.store');
               
    Route::put('test/{test}', 'TestController@update')
         ->name('test.test.update')
         ->where('id', '[0-9]+');

    Route::delete('/{test}/destroy','TestController@destroy')
         ->name('test.test.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'cliente',
], function () {

    Route::get('/', 'ClienteController@index')
         ->name('cliente.cliente.index');

    Route::get('/create','ClienteController@create')
         ->name('cliente.cliente.create');

    Route::get('/grid', 'ClienteController@grid')
         ->name('cliente.cliente.grid');

    Route::get('/show/{cliente}','ClienteController@show')
         ->name('cliente.cliente.show')
         ->where('id', '[0-9]+');

    Route::get('/{cliente}/edit','ClienteController@edit')
         ->name('cliente.cliente.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ClienteController@store')
         ->name('cliente.cliente.store');
               
    Route::put('cliente/{cliente}', 'ClienteController@update')
         ->name('cliente.cliente.update')
         ->where('id', '[0-9]+');

    Route::post('getCliente/{cliente}', 'ClienteController@getCliente')
        ->name('cliente.getCliente.update')
        ->where('id', '[0-9]+');

    Route::delete('/{cliente}/destroy','ClienteController@destroy')
         ->name('cliente.cliente.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'grupo',
], function () {

    Route::get('/', 'GrupoController@index')
         ->name('grupo.grupo.index');

    Route::get('/create','GrupoController@create')
         ->name('grupo.grupo.create');

    Route::get('/grid', 'GrupoController@grid')
         ->name('grupo.grupo.grid');

    Route::get('/show/{grupo}','GrupoController@show')
         ->name('grupo.grupo.show')
         ->where('id', '[0-9]+');

    Route::get('/{grupo}/edit','GrupoController@edit')
         ->name('grupo.grupo.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'GrupoController@store')
         ->name('grupo.grupo.store');
               
    Route::put('grupo/{grupo}', 'GrupoController@update')
         ->name('grupo.grupo.update')
         ->where('id', '[0-9]+');

    Route::delete('/{grupo}/destroy','GrupoController@destroy')
         ->name('grupo.grupo.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'debitos',
], function () {

    Route::get('/', 'DebitosController@index')
         ->name('debitos.debitos.index');

    Route::get('/create','DebitosController@create')
         ->name('debitos.debitos.create');

    Route::get('/grid', 'DebitosController@grid')
         ->name('debitos.debitos.grid');

    Route::get('/modalGrid', 'DebitosController@modalgrid')
        ->name('debitos.debitos.modalgrid');

    Route::get('/show/{debitos}','DebitosController@show')
         ->name('debitos.debitos.show')
         ->where('id', '[0-9]+');

    Route::get('/{debitos}/edit','DebitosController@edit')
         ->name('debitos.debitos.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DebitosController@store')
         ->name('debitos.debitos.store');

    Route::get('/cancelCharge/{code}', 'DebitosController@cancelCharge')
        ->name('debitos.cancelCharge');


    Route::get('/knob', 'DebitosController@knob')
        ->name('debitos.debitos.knob');
               
    Route::put('debitos/{debitos}', 'DebitosController@update')
         ->name('debitos.debitos.update')
         ->where('id', '[0-9]+');

    Route::delete('/{debitos}/destroy','DebitosController@destroy')
         ->name('debitos.debitos.destroy')
         ->where('id', '[0-9]+');


});

Route::group(
[
    'prefix' => 'cobranca',
], function () {

    Route::get('/', 'CobrancaController@index')
         ->name('cobranca.cobranca.index');

    Route::get('/create','CobrancaController@create')
         ->name('cobranca.cobranca.create');

    Route::get('/grid', 'CobrancaController@grid')
         ->name('[% grid_route_name %]');

    Route::get('/show/{cobranca}','CobrancaController@show')
         ->name('cobranca.cobranca.show')
         ->where('id', '[0-9]+');

    Route::get('/{cobranca}/edit','CobrancaController@edit')
         ->name('cobranca.cobranca.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CobrancaController@store')
         ->name('cobranca.cobranca.store');
               
    Route::put('cobranca/{cobranca}', 'CobrancaController@update')
         ->name('cobranca.cobranca.update')
         ->where('id', '[0-9]+');

    Route::delete('/{cobranca}/destroy','CobrancaController@destroy')
         ->name('cobranca.cobranca.destroy')
         ->where('id', '[0-9]+');

});
