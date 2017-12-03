<?php

namespace App\Http\Controllers;

use App\Inf_cupos;
use Illuminate\Http\Request;

class Inf_cuposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datos = Inf_cupos::join('clientes', 'clientes.id', '=', 'info_cupo.cliente_id' )
        ->select('info_cupo.*',
                'clientes.razon_social as razon_social')->getQuery()
        ->get();
          //  $datos =  DB::table('detpedidos')->get();//->toJson();
            if ($datos) {
           return view('inf_cupos.indexList', compact('datos'));
        //  dd($datos);
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
     * @param  \App\Inf_cupos  $inf_cupos
     * @return \Illuminate\Http\Response
     */
    public function show(Inf_cupos $inf_cupos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inf_cupos  $inf_cupos
     * @return \Illuminate\Http\Response
     */
    public function edit(Inf_cupos $inf_cupos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Inf_cupos  $inf_cupos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inf_cupos $inf_cupos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inf_cupos  $inf_cupos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inf_cupos $inf_cupos)
    {
        //
    }
}
