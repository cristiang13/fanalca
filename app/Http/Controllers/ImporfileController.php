<?php

namespace App\Http\Controllers;

use App\Stock;
use App\Client;
use App\Articulo;
use App\Inf_cupos;
use App\Detpedidos;
use Maatwebsite\Excel\Facades\Excel;
use Storage;
use PHPExcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use DB;
use Carbon\Carbon;
use Response;
class ImporfileController extends Controller
{
  public function import_file_disponibilidad()
  {
    return view('importFiles.disponibilidad');
  }

  public function cargar_datos(Request $request)
{

     $archivo = $request->file('archivo');
     $nombre_archivo=$archivo->getClientOriginalName();
     $extension=$archivo->getClientOriginalExtension();
     $r1=Storage::disk('archivos')->put($nombre_archivo,  \File::get($archivo) );
     $ruta  =  storage_path('archivos') ."/". $nombre_archivo;


  /*  $file = Input::file('archivo');
    $file_name = $file->getClientOriginalName();
    $file->move('files',$file_name);
    $path = $file->getRealPath();
    Excel::load('files/'.$file_name,function($reader){])
    */


 if ($r1) {

 Excel::selectSheets('PASO 2 DISPONIBILIDAD')->load($ruta,function($reader){

       $reader->calculate(false);
         $result = $reader->get();
      //  $sheet = $objExcel->getSheet(0);
      //   dd($result);


          $num_registro = DB::table('inventario')->count();
          if ($num_registro<=0) {
             $id=1;
          }
          else {
              $id =  Stock::orderBy('id', 'desc')->first()->id;
              $id++;
        }

         foreach($result as $sheet){
           $contador_id;


           $id_articulo = DB::table('articulos')->where('referencia',$sheet->referencia)->where('desc_detalle', $sheet->desc_detalle_ext_1)->value('id');
           // codigo para salir si ya no existen datos
           if (empty(($sheet->referencia)&&($sheet->desc_detalle_ext_1))) {
            break;
           }
           if (is_null($sheet->total)) {
                $sheet->total=0;
            }
            if (is_null($sheet->programacion_dia_anterior)) {
              $sheet->programacion_dia_anterior=0;
            }
           $total=$sheet->total;
           $prog_dia_ant=$sheet->programacion_dia_anterior;

           $disponibilidad_real= $sheet->total - $sheet->programacion_dia_anterior;




           $date = Carbon::now();
           $date = $date;
        //   $aux_id = DB::table('inventario')->where('created_at', $date)->value('id');
          // $fecha= new Carbon($fecha_inv);
          // $fecha->format('d-m-Y');


            //  echo $last_id;
      //   echo $id_articulo.' '.$sheet->referencia.'/'. $sheet->desc_detalle_ext_1.'***'.$total.'-'.$prog_dia_ant.'='.$disponibilidad_real. '<br>';//.'/'.'TOTAL'.$sheet->total.'-'.$sheet->programacion_dia_anterior.'='.$disponibilidad. '<br>';



        //  echo $id.'/'.$id_articulo.'<br>-'.$total.'-'.$prog_dia_ant.'='.$disponibilidad_real.'<br>';

          DB::table('inventario')->insert(

             ['id'=>$id,'articulo_id'=>$id_articulo,'dispo_total'=>$sheet->total,'prog_dia_ant'=>$sheet->programacion_dia_anterior,'dispo_real'=>($sheet->total - $sheet->programacion_dia_anterior)]
          );
        /*   $aux_inv= new Stock;
            $aux_inv->id=$id;
            $aux_inv->articulo_id=$id_articulo;
            $aux_inv->dispo_total=$sheet->total;
            $aux_inv->prog_dia_ant= $sheet->programacion_dia_anterior;
            $aux_inv->dispo_real=$disponibilidad_real;
            $aux_inv->save();*/


        }



   }, 'UTF-8');


Excel::selectSheets('PASO 4 INF DE CUPOS')->load($ruta,function($reader){
         $reader->calculate(false);
           $result = $reader->get();
        //  $sheet = $objExcel->getSheet(0);
    //   dd($result);  Integrity constraint violation: 1062 Duplicate entry '8000154' for key 'info_cupo_cliente_id_unique' (SQL: insert into `info_cupo` (`id`, `cliente_id`, `contado_a_hoy`, `cupo_de_credito_fanalca`, `cupo_de_credito_factoring`, `total_credito`, `updated_at`, `created_at`) values (2, 8000154, 0, 53334553, 0, 53334553, 2017-11-28 17:06:17, 2017-11-28 17:06:17))</p>


          $num_registro = DB::table('info_cupo')->count();
          if ($num_registro==0) {
             $id=1;
          }
          else {
              $id =  Inf_cupos::orderBy('id', 'desc')->first()->id;
              $id++;
        }

       foreach($result as $sheet)
    {

      $cliente = $sheet->razon_social_nombre_del_establecimiento;
      $cliente = trim($cliente, '.');
      //echo $cliente;

      if (empty($cliente)) {
        $id_cliente='null';
      }else {
        $id_cliente= DB::table('clientes')->where('razon_social', 'like', $cliente.'%')->value('id');
        if (is_string($sheet->contado_a_hoy)) {
          $sheet->contado_a_hoy=0;
        }
        if (empty($sheet->cupo_de_credito_factoring)) {
          $sheet->cupo_de_credito_factoring=0;
        }

        if (empty($sheet->cupo_de_credito_fanalca)||is_null($sheet->cupo_de_credito_fanalca)) {
        //if (!isset($sheet->cupo_de_credito_fanalca)){
          $sheet->cupo_de_credito_fanalca=0;
        }
        if (empty($sheet->contado_a_hoy)) {
          $sheet->contado_a_hoy=0;
        }
        $cupo = $sheet->contado_a_hoy+$sheet->cupo_de_credito_fanalca+$sheet->cupo_de_credito_factoring;
       // valida si el null(casillas en blanco) o si esta vacio el id cliente
        if (!(is_null($id_cliente)||empty($id_cliente))) {
          $aux_inv= new Inf_cupos;
           $aux_inv->id=$id;
           $aux_inv->cliente_id=$id_cliente;
           $aux_inv->contado_a_hoy=$sheet->contado_a_hoy;
           $aux_inv->cupo_de_credito_fanalca=$sheet->cupo_de_credito_fanalca;
           $aux_inv->cupo_de_credito_factoring= $sheet->cupo_de_credito_factoring;
           $aux_inv->total_credito=$cupo;
           $aux_inv->save();
        }


      }


    // echo ($id_cliente);

  // echo $id_cliente.'/ '.$sheet->nit.'--'.$cliente.'/'.$sheet->contado_a_hoy.'+'.$sheet->cupo_de_credito_fanalca.'+'.$sheet->cupo_de_credito_factoring.'='.$cupo. '<br>';//.'/'.'TOTAL'.$sheet->total.'-'.$sheet->programacion_dia_anterior.'='.$disponibilidad. '<br>';

    }

  }, 'UTF-8');



 Excel::selectSheets('DATOS')->load($ruta,function($reader){
          $reader->calculate(false);
          $result = $reader->get();
          $fecha=Carbon::now()->format('Y-m-d');

          foreach ($result as  $value) {

               $suc_cliente= $value->desc_sucursal_factura;
                $refe= $value->referencia;
                $des_detalle= $value->desc_detalle_ext_1;

                if (!(empty($suc_cliente)||is_null($suc_cliente))) {
                  $id_cliente= DB::table('sucursal_cliente')->where('razon_sucursal', $suc_cliente)->value('id');
                  $id_articulo = DB::table('articulos')->where('referencia', $value->referencia)->where('desc_detalle', $value->desc_detalle_ext_1)->value('id');

                  if (empty($value->cant_pedida)) {
                    $value->cantpedida=0;
                  }
                  if (empty($value->cant_pendiente)) {
                    $value->cant_pendiente=0;
                  }
                      // codigo para evitar duplicdo de llave primaria
                    $count = DB::table('detpedidos')->where('no_doc', $value->nro_documento)->where('articulo_id', $id_articulo)->where('sucursal_id', $id_cliente)->count();
                  //  if ($count==0) {
                      $det_pedido = new Detpedidos;
                      $det_pedido->no_doc= $value->nro_documento;
                      $det_pedido->sucursal_id=  $id_cliente;
                      $det_pedido->articulo_id=$id_articulo;
                      $det_pedido->cant_pedida=$value->cant_pedida;
                      $det_pedido->marca_update=0;
                      $det_pedido->cant_pendiente= $value->cant_pendiente;
                      $det_pedido->save();
                    /*} ojooo falta corregir la condicion else
                    elseif ($count>0) {
                      $cant_ped = DB::table('detpedidos')->where('no_doc', $value->nro_documento)->where('articulo_id', $id_articulo)->where('sucursal_id', $id_cliente)->value('cant_pedida');
                      $cant_pend = DB::table('detpedidos')->where('no_doc', $value->nro_documento)->where('articulo_id', $id_articulo)->where('sucursal_id', $id_cliente)->value('cant_pendiente');

                      $cant_ped = $cant_ped + $value->cantpedida;
                      $cant_pend = $cant_pend + $value->cant_pendiente;

                      DB::table('detpedidos')->where('no_doc', $value->nro_documento)->where('articulo_id', $id_articulo)->where('sucursal_id', $id_cliente)->update(['cant_pedida' => $cant_ped,'cant_pendiente' => $cant_pend ]);


                    }*/

                    //$xcliente= DB::table('clientes')->where('razon_sucursal', 'OSORIO RIVERO CIRO ALFONSO OCAÑA CL 10')->value('id');

                    //dd($xcliente);
            //  echo 'ID'.$value->nro_documento.'CLIENTE='.$id_cliente.',det arti='.$value->desc_sucursal_factura.'***'.$id_articulo.'<br>';

                    }


            }



  }, 'UTF-8');


      //    $stock = DB::table('disponibilidad')->get();

      //  return view('disponibilidad.indexList', ['datos'=>$stock]);

 return view("mensajes.msj_correcto")->with("msj"," Archivos Cargados Correctamente");

  }else {
     return view("mensajes.msj_rechazado")->with("msj"," Error al subir archivo");
   }

    }


}
