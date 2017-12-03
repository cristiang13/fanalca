@extends('template')

@section('content')

  <div class="card mb-3">
      <form class="" action="{{ route('detpedidos.completar') }}" method="post">
    <div class="card-header">
      <i class="fa fa-table"></i>
      Disponibilidad de artículos
    </div>

    <div class="card-body">



      <div class="table-responsive">

        <table class="table " width="100%" id="table_inventario" cellspacing="0">
          <thead>
            <tr>
                 <th colspan="3" style="text-align: center">Moto</th>
                 <th colspan="3"style="text-align: center">Disponibilidad</th>

             </tr>
            <tr>
              <th>id</th>
              <th>Referencia</th>
              <th>Descripcion detalle</th>
              <th>Disponibilidad total</th>
              <th>Programacion dia anterior</th>
              <th>Disponibilidad real</th>
            </tr>
          </thead>

          <tbody>

            @foreach ($datos as $key => $listado)
              <tr>
                <td >{{$listado->id}}</td>
                <td>{{$listado->referencia}}</td>
                <td>{{$listado->desc_detalle}}</td>
                <td>{{$listado->dispo_total}}</td>
                <td>{{$listado->prog_dia_ant}}</td>
                <td>{{$listado->dispo_real}}</td>

              </tr>

          @endforeach




          </tbody>
        </table>
      </div>
    </div>

    </form>
 </div>


@stop
