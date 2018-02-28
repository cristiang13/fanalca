@extends('template')

@section('content')



  <div class="card">

    <div class="card-header">
      <i class="fa fa-table"></i>
      Tabla de datos programación de viajes


    </div>

    <div class="card-body">



      <div style="overflow-x:auto;" >

        <table id="table_progViaje" class="table table-condensed " cellspacing="0">
          <thead>
            <tr>

              <th>Numero de viaje</th>
              <th>Numero de documento</th>
              <th>Razon social</th>
              <th>Descripcion sucursal factura </th>
              <th>Referencia</th>
              <th>Descripcion detalle</th>
              <th>Dantidad programada</th>
              <th>Condición de pago</th>

            </tr>
          </thead>

          <tbody>

            @foreach ($datos as  $listado)




              <tr>

                <td class="" style="padding-right: 0px; padding-left:0px; font-size:14px">{{$listado->no_viaje}}</td>
                <td>{{$listado->no_doc}}</td>
                <td>{{$listado->razon_social}}</td>
                <td>{{$listado->razon_surcursal}}</td>
                <td>{{$listado->referencia}}</td>
                <td>{{$listado->desc_detalle}}</td>
                <td>{{$listado->cant_programado}}</td>
                <td> @if ($listado->cond_pago == 1)
                    contado
                  @elseif ($listado->cond_pago == 2)
                    credito 30 días

                 @elseif ($listado->cond_pago == 3)
                   credito 60 días
                @elseif ($listado->cond_pago == 4)
                  credito 90 días
                 @endif


                  </td>


              </tr>

          @endforeach




          </tbody>
        </table>
      </div>
    </div>

    </form>
 </div>


@stop
