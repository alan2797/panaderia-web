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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('almacen/categoria','CategoriaController');

Route::resource('almacen/producto','ProductoController');
Route::resource('almacen/insumo','InsumoController');
Route::resource('almacen/distribucion','DistribucionController');
Route::resource('reportesCliente','ReporteClienteController');
Route::resource('reportesProducto','ReporteProductoController');
Route::resource('reportesProduccion','ReporteProduccionController');
Route::resource('estadisticaProducto','EstadisticaProductoController');
Route::resource('estadisticaCliente','EstadisticaClienteController');
Route::resource('almacen/transporte','TransporteController');
Route::resource('usuario/cliente','ClienteController');
Route::resource('usuario/proveedor','ProveedorController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('produccion/producto','DetalleproductoController');
//shoping
//Route::resource('shoping/productolista','ProductolistaController');
Route::resource('shoping/productolista','ShopingController');
Route::resource('atender/atendido','ConfirmarVentaController');
Route::auth();

Route::get('/almacen/transporte','TransporteController@index');

Route::post('color','PersonaController@color')->name('color');
