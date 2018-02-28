<?php

namespace App\Http\Controllers;

use App\Detpedidos;
use App\Stock;
use App\Articulo;
use App\SucurClient;
use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Response;
use DB;
use Datatables;
use Carbon\Carbon ;
use Illuminate\Support\Facades\Redirect;



class DetpedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
      $datos = Detpedidos::join('sucursal_cliente', 'sucursal_cliente.id', '=', 'detpedidos.sucursal_id')
        ->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id' )
        ->select('detpedidos.*',
                'sucursal_cliente.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')->getQuery()
        ->get();
        // codigo para obtener el ultimo id usado,para tomar la disponibilidad del dia.
       $id =  Stock::orderBy('id', 'desc')->first()->id;
          $dispo_art= Stock::where('id',$id)->getQuery()->get();//->toJson();
            if ($datos) {
            //  dd($dispo_art);
           return view('disponibilidad.indexList', compact('datos','dispo_art'));
            // return datatables::eloquent(Stock::query())->make(true);
  //  return view('list_disp');
    // dd($datos);




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
    public function actualizar(Request $request)
    {

        $data= $request->all();

       //dd($data);
       $no_doc=$data['id_doc'];
       $sucursal_id=$data['sucursal_id'];
       $articulo_id=$data['articulo_id'];
       $aux_id= $data['id_doc'].$data['articulo_id'];
       $marca_update=1;
       $id_inventario =  Stock::orderBy('id', 'desc')->first()->id;

       $fecha=Carbon::now()->format('Y-m-d');


       $articulo= DB::table('articulos')->where('id', $articulo_id)->value('referencia');
       $disponibilidad= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');

  if ($data['cant_prog']>$data['cant_pedida']) {
    return response()->json([
      'msg' => "La cantidad programada excede la cantidad pedida",
      ]);
  }else {
        if ($disponibilidad>= $data['cant_prog']) {
               $cantPendiente= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                      ->where('sucursal_id', $sucursal_id)->value('cant_pendiente');
                if ($cantPendiente<$data['cant_prog'] || $cantPendiente == 0) {
                  $msg= "La cantidad programada excede la cantida pendiente";
                  return response()->json([
                  'msg' => $msg,]);


                   }else {

                  $aux_cant_pendiente = $cantPendiente - $data['cant_prog'];

                   $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                               ->where('sucursal_id', $sucursal_id)
                                               ->update(['cant_programado' => $data['cant_prog'],'costo_programado' =>$data['cost_prog'] ,'cant_pendiente'=>$aux_cant_pendiente, 'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update,'updated_at'=>$fecha]);

                    $aux_dispo= $disponibilidad - $data['cant_prog'];
                    DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->update(['dispo_real'=>$aux_dispo]);

                    $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');
                    $valor_pedido= DB::table('detpedidos')->where('no_doc', $no_doc)->sum('costo_programado');
                    $x=gettype($dispo_aux);

                    return response()->json([
                         'msg' => $dispo_aux,
                         'articulo_id'=>$articulo_id,
                         'aux_id'=> $aux_id,
                         'aux_cant_pend'=>$aux_cant_pendiente,
                         'aux_no_doc'=> $no_doc,
                       'aux_valor_pedido'=> $valor_pedido,]);
                   }

          }else {
            $msg= "La cantidad programada excede la disponibilidad de articulo";
            return response()->json([
            'msg' => $msg,]);
          }

      }

  }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detpedidos  $detpedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Detpedidos $detpedidos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detpedidos  $detpedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $datos,$id)
    {
     $cliente = Input::get("sucursal_id");
      $articulo=Input::get("articulo_id");
      $datos = Detpedidos::join('sucursal_cliente', 'sucursal_cliente.id', '=', 'detpedidos.sucursal_id')
        ->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id' )
        ->select('detpedidos.*',
                'sucursal_cliente.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')
                ->where('detpedidos.no_doc', $id)->where('detpedidos.sucursal_id', $cliente)->where('detpedidos.articulo_id', $articulo)->getQuery()
        ->get();
      $fecha=Carbon::now()->format('Y-m-d');
    // $disponibilidad = Stock::whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
      $disponibilidad = Stock::find($articulo);
        $dispo= $disponibilidad->dispo_real;


// codigo para mostrar dispo_real cuando hallan para registros de varios dias
  /* $disponibilidad = DB::table('inventario')->whereDate('created_at', '=', Carbon::now()->format('Y-m-d'))->get();
         //echo dd($datos);
      // $datos->put('dispo_real',$dispo);
      foreach ($disponibilidad as  $value) {
          if($value->articulo_id == $articulo){
           echo $value.'<br>';
         }
     }*/

    //  echo $datos;
      // dd($disponibilidad);

     return view('disponibilidad.edit', compact('datos','dispo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detpedidos  $detpedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detpedidos $detpedidos)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detpedidos  $detpedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detpedidos $detpedidos)
    {
        //
    }

    public function completar(Request $request)
    {
    //  $form= $request->all();
      // dd($form);

     $datos=$request->input("check_list");
        //echo count($datos);
      //  dd($datos);


                  $cont = array();
                  $aux_client=array();

                  for ($i=0; $i < count($datos) ; $i++) {
                  //  echo $datos[$i].'<br>';
                  //$val[0]:no_doc,$val[1]:sucursal_id,$val[3]:articulo_id
                    $val=explode(",",$datos[$i]);
                         $a= $val[0];

                          if(isset($cont[$a])){
                           //dd($k);

                               $cont[$a]=$cont[$a]+1;
                              // echo $cont[$a];
                         }else {
                           $cliente= DB::table('sucursal_cliente')->where('id', $val[1])->value('razon_sucursal');
                           $aux=[
                             "no_doc"=>$val[0],
                             "id_sucursal"=>$val[1],
                             "sucursal"=>$cliente,

                           ];
                            array_push($aux_client,$aux);
                               $cont[$a]=1;
                           }
                       }

        // dd($aux_client);


        $array_stock=array();
        $array_aux=array();
        for ($i=0; $i <count($datos) ; $i++) {
          $val=explode(",",$datos[$i]);
          //dd($val);
           $aux_stock = [
                "id"=>$val[2],
                 "referencia" => $val[4],
                 "desc_detalle" => $val[5],
                 "disponibilidad"=>$val[3],
               ];

            array_push($array_stock,$aux_stock);


      }
      //  dd($array_stock);

        $id_inventario =  Stock::orderBy('id', 'desc')->first()->id;
        $arraydatos= array();
        $arraydispo=array();
        for ($i=0; $i < count($datos) ; $i++) {
        //  echo $datos[$i].'<br>';
        //$val[0]:no_doc,$val[1]:sucursal_id,$val[3]:articulo_id
          $val=explode(",",$datos[$i]);


          //  echo $val[0].' '.$val[1].' '.$val[2].'<br><br>';
            $d= Detpedidos::join('sucursal_cliente', 'sucursal_cliente.id', '=', 'detpedidos.sucursal_id')
                ->join('articulos', 'articulos.id', '=', 'detpedidos.articulo_id')
                ->select('detpedidos.*',
                        'sucursal_cliente.razon_sucursal as razon_surcursal','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle','articulos.precio_unit as precio')->where('no_doc', $val[0])->where('articulo_id', $val[2])
                ->where('sucursal_id', $val[1])->getQuery()
                ->get();

          $dispo_arts= Stock::join('articulos', 'articulos.id','=','inventario.articulo_id')
          ->select('inventario.*','articulos.referencia as referencia', 'articulos.desc_detalle as desc_detalle')
                  ->where('inventario.id', $id_inventario)
                  ->where('articulo_id', $val[2])->getQuery()
                  ->get();

                //  array_push($arraydatos,$val[3]);
                array_push($arraydispo, $dispo_arts);
               array_push($arraydatos, $d);


                // dd($val);


        }
   //dd($arraydispo);
        $cont = array();
        $aux=array();
     //  for ($i=0; $i <count($array_stock) ; $i++) {
         foreach ($arraydispo as  $value) {
             foreach ($value as $k) {
               $a=$k->articulo_id;

                if(isset($cont[$a])){
                 //dd($k);

                     $cont[$a]=$cont[$a]+1;
                    // echo $cont[$a];
               }else {
                 $aux_stock = [
                      "id"=>$k->articulo_id,
                       "referencia" => $k->referencia,
                       "desc_detalle" => $k->desc_detalle,
                       "disponibilidad"=>$k->dispo_real,
                     ];

                  array_push($aux,$aux_stock);
                     $cont[$a]=1;
                 }
             }

        /*  */
         }



          return view('list_disp', compact('arraydatos','aux','aux_client'));
        //array_push($arraydatos, $compact);
      //  dd($arraydatos);
      // dd($aux);


    }


}
