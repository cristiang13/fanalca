@extends('template')

@section('content')




  <div class="card mb-3">
      <form class="" action="{{ route('detpedidos.completar') }}" method="post">
    <div class="card-header">
      <i class="fa fa-table"></i>
      Tabla de datos pedidos

        <button type="submit" class="btn btn-danger  btn-sm" style="float: right;">Programar viaje</button>
    </div>

    <div class="card-body">



      <div class="table-responsive">
     <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
        <table class=" table "  id="example" cellspacing="0">
          <thead>
            <tr>
               <th></th>
              <th>No Documento</th>
              <th>Cantidad pedida</th>
              <th>Cantidad pendiente</th>
              <th>Razon Social Cliente </th>
              <th>Referencia</th>
              <th>descripcion detalle</th>
              <th>precio</th>
              <th>disponibilidad real</th>

              <th></th>


            </tr>
          </thead>

          <tbody>

            @foreach ($datos as $key => $listado)



              @php
              $aux = 0;
              foreach ($dispo_art as  $value){

                  if ($value->articulo_id == $listado->articulo_id){
                    $aux = $value->dispo_real;
                  }
                }
               $dato = ['no_doc' => $listado->no_doc,'sucursal_id' => $listado->sucursal_id,'articulo_id'=>$listado->articulo_id, 'dispo_real' => $aux,
                       'referencia'=>$listado->referencia,'desc_detalle'=>$listado->desc_detalle,'cant_pedida'=>$listado->cant_pedida,'cant_pendiente'=>$listado->cant_pendiente];
               $value = implode(",", $dato);
              @endphp



              <tr>
                <td class="details-control" data-agencies='["agency22", "agency33","agency17","agency89"]'  width="2%"></td>
                <td>{{$listado->no_doc}}</td>
                <td>{{$listado->cant_pedida}}</td>
                <td>{{$listado->cant_pendiente}}</td>
                <td>{{$listado->razon_surcursal}}</td>
                <td>{{$listado->referencia}}</td>
                <td>{{$listado->desc_detalle}}</td>
                <td>{{$listado->precio}}</td>
                <td>{{$aux}}</td>
                <td> <input type="checkbox" name="check_list[]" value= '{{$value}}'></td>


              </tr>

          @endforeach




          </tbody>
        </table>
      </div>
    </div>

    </form>
 </div>


@stop
