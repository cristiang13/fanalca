<?php

namespace App\Http\Controllers;

use App\Detpedidos;
use App\Stock;
use App\Articulo;
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

      // dd($data);
       $no_doc=$data['id_doc'];
       $sucursal_id=$data['sucursal_id'];
       $articulo_id=$data['articulo_id'];
       $marca_update=1;
       $id_inventario =  Stock::orderBy('id', 'desc')->first()->id;

       $fecha=Carbon::now()->format('Y-m-d');


       $articulo= DB::table('articulos')->where('id', $articulo_id)->value('referencia');
       $disponibilidad= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');

    /*    $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                               ->where('sucursal_id', $sucursal_id)
                               ->update(['cant_programado' => $data['cant_prog'],'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update ]);





     $validationsql= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                              ->where('sucursal_id', $sucursal_id)->where('cant_programado', $data['cant_prog'])->where('costo_programado',$data['cost_prog'])
                              ->where('no_viaje',$data['num_viaje'])->where('cond_pago',$data['condicion_pago'])->where('marca_update', $marca_update)->count();
    */
      // $dispo_art='hola';
    //  return  $dispo_art;

        //  echo ''.$articulo.'a la factura No:'. $no_doc;
  if ($data['cant_prog']>$data['cant_pedida']) {
    return response()->json([
      'msg' => "La cantidad programada excede la cantidad pedida",
      ]);
  }else {
    if ($disponibilidad>= $data['cant_prog']) {

      $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                   ->where('sucursal_id', $sucursal_id)
                                   ->update(['cant_programado' => $data['cant_prog'],'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update,'updated_at'=>$fecha]);
      $aux_dispo= $disponibilidad - $data['cant_prog'];
      DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->update(['dispo_real'=>$aux_dispo]);

         $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');
         $x=gettype($dispo_aux);
           return response()->json([
             'msg' => $dispo_aux,
           'articulo_id'=>$articulo_id,]);
                //  return $dispo_aux;




  //$msg;
      }else {
        $msg= "La cantidad programada excede la disponibilidad de articulo";
        return response()->json([
        'msg' => $msg,]);
      }
  }






//----
      /*    $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                     ->where('sucursal_id', $sucursal_id)
                                     ->update(['cant_programado' => $data['cant_prog'],'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update ]);

        // echo ''.$articulo.'a la factura No:'. $no_doc.'-';
         $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');
         $x=gettype($dispo_aux);
         return response()->json([
       'msg' => $dispo_aux,]);
    */
//  ---------




      /* if ($validationsql>0) {
            $old_cant_prog= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                 ->where('sucursal_id', $sucursal_id)->value('cant_programado');
           $new_cant_prog=$data['cant_prog'];
           $cant_faltante=$new_cant_prog-$old_cant_prog;


      //----------------------------------------------------------

      $old_cant_prog= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                           ->where('sucursal_id', $sucursal_id)->value('cant_programado');
     $new_cant_prog=$data['cant_prog'];
     $cant_faltante=$new_cant_prog-$old_cant_prog;

     if (is_null($old_cant_prog)) {
       $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                  ->where('sucursal_id', $sucursal_id)
                                  ->update(['cant_programado' => $data['cant_prog'],'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update ]);

        $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');
        $x=gettype($dispo_aux);
          return response()->json([
            'msg' => $dispo_aux,]);
               //  return $dispo_aux;
             }else{
               switch (TRUE) {
                 case ($cant_faltante>0):
                 $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                            ->where('sucursal_id', $sucursal_id)
                                            ->update(['cant_programado' => $cant_faltante,'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update ]);

                  $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');
                  $x=gettype($dispo_aux);
                    return response()->json([
                      'msg' => $dispo_aux,]);
                   break;
                   case ($cant_faltante<0):
                   $reset_dispo=$disponibilidad-$old_cant_prog;
                   //valor absoluto
                   $parse_new_cant=abs($cant_faltante);

                   $dispo_update=DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->update(['dispo_real'=>$reset_dispo]);

                   $prog_art= DB::table('detpedidos')->where('no_doc', $no_doc)->where('articulo_id', $articulo_id)
                                              ->where('sucursal_id', $sucursal_id)
                                              ->update(['cant_programado' => $cant_faltante,'costo_programado' =>$data['cost_prog'] ,'no_viaje'=>$data['num_viaje'],'cond_pago'=>$data['condicion_pago'],'marca_update'=> $marca_update ]);

                  $dispo_aux= DB::table('inventario')->where('id', $id_inventario)->where('articulo_id', $articulo_id)->value('dispo_real');



                   return response()->json([
                     'msg' => $dispo_aux,]);
                   break;
                   case ($cant_faltante=0):
                   return response()->json([
                     'msg' => 'cantidad programda nueva = cantidad programada antigua',]);
                   break;

                   default:
                   return response()->json([
                     'msg' => 'no cumples con la condiciones',]);
                   break;

               }

             }




//------------------------------




              }else {
                  //  echo "-".$no_doc.'-'.$articulo_id.'-'.$sucursal_id;
                 echo "no existe registro";
               }
               */






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
        $array_stock=array();
        $array_aux=array();
        for ($i=0; $i <count($datos) ; $i++) {
          $val=explode(",",$datos[$i]);

           $aux_stock = [
                "id"=>$val[2],
                 "referencia" => $val[4],
                 "desc_detalle" => $val[5],
                 "disponibilidad"=>$val[3],
               ];

            array_push($array_stock,$aux_stock);


      }


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

                  array_push($arraydatos,$val[3]);
                array_push($arraydispo, $dispo_arts);
               array_push($arraydatos, $d);





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



          return view('list_disp', compact('arraydatos','aux'));
        //array_push($arraydatos, $compact);
      //  dd($arraydatos);
      // dd($aux);


    }


}
