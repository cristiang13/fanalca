<?php

namespace App\Http\Controllers;

use App\Articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $articulos= DB::table('articulos')->get();
    //  dd($articulos);
      return view('articulos.index',compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input = $request->all();
      //dd($input);
      $articulo = Articulo::create($input);
      //dd($articulo);
      $articulo->save();

      //Flash('Create articulo Complete!', 'success');
      return redirect('articulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(Articulo $articulo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $articulo = DB::table('articulos')->where('id',$id)->get();
      //dd($articulo);
      return view('articulos.edit', compact('articulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $articulo = Articulo::where('id',$id)->first();
    //$articulo= Articulo::findOrFail($id);


      $articulo->referencia= $request->referencia;
      $articulo->desc_detalle= $request->detalle;
      $articulo->precio_unit= $request->precio;

      $aux = new Articulo;
      $aux = $articulo;
      $aux->save();


    //  $articulo->fill($request)->save();
      return redirect('articulos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Articulo::findOrFail($id)->delete();
      return redirect('articulos');
    }
}
