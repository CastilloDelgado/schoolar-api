<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Users Route
Route::apiResource('users', 'API\UserController');
Route::post('login', 'API\UserController@login');
Route::get('alumnos', 'API\UserController@getAlumnos');
Route::get('maestros', 'API\UserController@getMaestros');
Route::get('admins', 'API\UserController@getAdmins');
Route::post('get-info', 'API\UserController@getInfo');
Route::post('load-file', 'API\UserController@loadFile');
Route::get('get-pedidos/{id}', 'API\UserController@getPedidos');
Route::post('assign-group', 'API\UserController@assignGroup');

//Avisos Route
Route::apiResource('avisos', 'API\AvisoController');
Route::post("avisos/find-avisos", 'API\AvisoController@find');

//Materias Route
Route::apiResource('materias', 'API\MateriaController');
Route::post('materias/find-materias', 'API\MateriaController@find');

//Grupos Route
Route::apiResource('grupos', 'API\GrupoController');
Route::post('grupos/find-grupos', 'API\GrupoController@find');

//Pedidos Route
Route::apiResource('pedido', 'API\PedidoController');
Route::get('pedidos', 'API\PedidoController@show');
//Route::post('pedidos/create', 'API\PedidoController@store');
//Productos Route
Route::apiResource('prod-servs', 'API\ProdServController');
//Route::get('prod-servs', 'API\ProdServController@show');

//Configuración de la Aplicación
Route::apiResource('app-config', 'API\AppConfigurationController');

//Movimiento Route
Route::apiResource('movimiento', 'API\MovimientoController');
Route::get('mov-id-pedido/{id}', 'API\MovimientoController@showByIdPedido');

//Invoice Route
Route::apiResource('invoice', 'API\InvoiceController');

//user_info_invoice Route
Route::apiResource('user-info-invoice', 'API\UserInfoInvoiceController');

//Schedules Route
Route::apiResource('schedule', 'API\ScheduleController');

