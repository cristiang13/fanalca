@extends('template')

@section('content')

    <div class="card mb-3">
      <div class="card-header">
        <i class="fa fa-table"></i>
        Informacion de cupos
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="compact table " width="105%" id="table_cupo" cellspacing="0">
            <thead>
                <tr>
                  <th>id</th>
                  <th>Nit</th>
                  <th>Razon social cliente</th>
                  <th>Contado a hoy</th>
                  <th>Cupo de credito fanalca</th>
                  <th>Cupo de credito factoring</th>
                  <th>Total credito</th>
                </tr>
            </thead>

            <tbody>

              @foreach ($datos as $listado)

                <tr>
                  <td>{{$listado->id}}</td>
                  <td>{{$listado->cliente_id}}</td>
                  <td>{{$listado->razon_social}}</td>
                  <td>$ {{ number_format($listado->contado_a_hoy)}}</td>
                  <td>$  {{number_format($listado->cupo_de_credito_fanalca)}}</td>
                  <td>$ {{number_format($listado->cupo_de_credito_factoring)}}</td>
                  <td>$ {{number_format($listado->total_credito)}}</td>


                </tr>

            @endforeach



            </tbody>
          </table>
        </div>
      </div>


   </div>

@stop
