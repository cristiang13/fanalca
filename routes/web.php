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
    return view('auth.login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/index', function(){
	return view('indexList');
});
Route::resource('/detpedidos', 'DetpedidosController');
Route::resource('/stock', 'StockController');
Route::resource('/cupos', 'Inf_cuposController');
Route::resource('/users', 'UsersController');
Route::resource('/articulos', 'ArticuloController');

Route::get('/updatePassword', 'UsersController@password');
Route::post('/users/updatePassword', array('uses' => 'UsersController@updatePassword', 'as' => 'detpedidos.updatePassword'));

Route::get('api/inventario', function(){
  return Datatables::eloquent(Detpedidos::query())->make(true);
});

Route::resource('/progviaje', 'Prog_viajeController');
Route::get('/import/disponibilidad', 'ImporfileController@import_file_disponibilidad');
Route::post('/import/cargar_file_dispo', 'ImporfileController@cargar_datos');
Route::post('/detpedidos/completar',  array('uses' => 'DetpedidosController@completar', 'as' => 'detpedidos.completar'));
Route::get('/detpedidos/listapedidos', 'DetpedidosController@listapedidos');

Route::post('/detpedidos/actualizar',  array('uses' => 'DetpedidosController@actualizar', 'as' => 'actualizar'));

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset');
