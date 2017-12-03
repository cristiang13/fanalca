<?php

namespace App\Http\Controllers;

use App\Prog_viaje;
use Carbon\Carbon;
use App\Detpedidos;
use Illuminate\Http\Request;
use Response;
use DB;

class Prog_viajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $fecha=Carbon::now()->format('Y-m-d');
      //$fecha= explode(" ",$date);
    // $date->format('d-m-Y');
    // $lista=  Detpedidos::whereDate('updated_at', '=', '2017-09-21')->getQuery()->get();
    $datos = Detpedidos::join('sucursal_cliente', 'sucursal_cliente.id', '=', 'detpedidos.sucursal_id')
      ->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id' )->join('clientes', 'clientes.id', '=', 'sucursal_cliente.cliente_id')->where('marca_update', 1)->where('updated_at',$fecha)
      ->select('detpedidos.*',
              'sucursal_cliente.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio','clientes.razon_social as razon_social')
              ->getQuery()->get();



      // dd($datos);

      //  echo $date;

     return view('prog_viajes.indexList', compact('datos'));

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
        $input= $request->all();
        $prog_viaje= new Prog_viaje;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Prog_viaje  $prog_viaje
     * @return \Illuminate\Http\Response
     */
    public function show(Prog_viaje $prog_viaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Prog_viaje  $prog_viaje
     * @return \Illuminate\Http\Response
     */
    public function edit(Prog_viaje $prog_viaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Prog_viaje  $prog_viaje
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prog_viaje $prog_viaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prog_viaje  $prog_viaje
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prog_viaje $prog_viaje)
    {
        //
    }
}
