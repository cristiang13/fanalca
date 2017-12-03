<?php

namespace App\Http\Controllers;

use App\Stock;
use Storage;
use Excel;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Response;
use DB;

class StockController extends Controller
{

  // se realiza un trigger para actualizar inventario una vez se pida una margin-bottom
  //CREATE TRIGGER `inventario` AFTER UPDATE ON `detpedidos` FOR EACH ROW UPDATE inventario SET dispo_rea = dispo_real - new.cant_programado WHERE articulo_id = NEW.articulo_id AND id= 1;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

$datos = Stock::join('articulos', 'articulos.id', '=', 'inventario.articulo_id' )
	->select('inventario.*',
          'articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')->getQuery()
	->get();
    //  $datos =  DB::table('detpedidos')->get();//->toJson();
      if ($datos) {


      //  dd($datos);
    return view('inventario.indexList', compact('datos'));

   }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $datos,$id)
    {
    /*  $cliente = Input::get("cliente_id");
      $articulo=Input::get("articulo_id");
      $datos = Stock::join('clientes', 'clientes.id', '=', 'detpedidos.cliente_id' )
      	->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id' )
      	->select('detpedidos.*',
                'clientes.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')
                ->where('detpedidos.no_doc', $id)->where('detpedidos.cliente_id', $cliente)->where('detpedidos.articulo_id', $articulo)->getQuery()
      	->get();

    //  $inside_data = DB::table('detpedidos')->where('no_doc', $nro_documento)->first();
        //  echo dd($datos);

     return view('disponibilidad.edit', compact('datos'));*/


  }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      /*$cliente = Input::get("cliente_id");
      $articulo=Input::get("articulo_id");
      $datos = Stock::join('clientes', 'clientes.id', '=', 'detpedidos.cliente_id' )
      	->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id' )
      	->select('detpedidos.*',
                'clientes.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')
                ->where('detpedidos.no_doc', $id)->where('detpedidos.cliente_id', $cliente)->where('detpedidos.articulo_id', $articulo)->getQuery()
      	->get();*/
        $articulo=Input::get("articulo_id");
      echo $articulo;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }







	}
