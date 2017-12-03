@extends('template')

@section('content')

  <div class="card  " >

    <div class="card-header ">
      Ingresar pedido

    </div>
    <div class="card-body">

      <div class="row">


      </div>
      <div class="table table-responsive">

        <table   id="table_programacion"class="table" cellspacing="0" width="100%">

          <thead>

            <tr>
              <th></th>
              <th>No Documento</th>
              <th>Razon social</th>
              <th>Referencia</th>
              <th>Descripcion</th>
              <th>Cantidad pedida</th>
              <th>Cantidad pendiente</th>
              <th>Cantidad programada</th>
              <th>Costo programado</th>
              <th>Numero de viaje</th>
              <th>condicion de pago</th>
              <th></th>
            </tr>
          </thead>
              <tbody>


                        @for ($i=0; $i < count($arraydatos); $i++)


                            @if (($i % 2) == 0)
                                  @php
                                $dispo_real = $arraydatos[$i];
                                @endphp
                            @else

                                  @foreach ($arraydatos[$i] as $listado)

                                  <tr>

                                  <td class="details-control" data-agencies='["agency22", "agency33","agency17","agency89"]'  width="2%"></td>

                                  <form id="form_entrada "class="form_entrada " action="actualizar" method="post">


                                      <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" >
                                      <input type="hidden" id="no_doc"name="id_doc" value="{{$listado->no_doc}}">
                                      <input type="hidden" id="articulo_id"name="articulo_id" value="{{$listado->articulo_id}}">
                                      <input type="hidden" id="sucursal_id"name="sucursal_id" value="{{$listado->sucursal_id}}">
                                      <input type="hidden" id="cant_pedida"name="cant_pedida" value="{{$listado->cant_pedida}}">
                                      <input type="hidden" id="precio{{$listado->no_doc}}{{$listado->articulo_id}}" name="precio"  value="{{$listado->precio}}">


                                      <td id="prueba">{{$listado->no_doc}}</td>
                                      <td>{{$listado->razon_surcursal}}</td>
                                      <td>{{$listado->referencia}}</td>
                                      <td>{{$listado->desc_detalle}}</td>
                                      <td>{{$listado->cant_pedida}}</td>
                                      <td>{{$listado->cant_pendiente}}</td>
                                      <td><input type="number" class="form-control" id="cant_prog" clave="{{$listado->no_doc}}{{$listado->articulo_id}}" name="cant_prog" min="0"  required > </td>

                                      <td><input type="number" class="size form-control" id="cost_proga{{$listado->no_doc}}{{$listado->articulo_id}}"  name="cost_prog"  aria-describedby="nameHelp" required style="  width:80%; margin-left: 2%;"></td>
                                      <td><input type="text" class="form-control" id="num_viaje" name="num_viaje"aria-describedby="nameHelp" required></td>
                                      <td><select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelectPref" name="condicion_pago" style="height:26px;">
                                            <option value="1">contado</option>
                                            <option value="2">Credito 30 dias</option>
                                            <option value="3">Credito 60 dias</option>
                                            <option value="3">Credito 90 dias</option>
                                          </select>
                                      </td>
                                      <td>
                                          <input type="submit" id="update"class="btn btn-danger btn-sm "  value="ingresar"  >

                                  </form>

                                      </td>

                                    </tr>

                              @endforeach


                         @endif

                        @endfor


              </tbody>


        </table>
      </div>
    </div>


 </div>





 <div class="row" style="padding-top:2%;">
   <div  class="col-md-10">
    <div class="card ">
              <div class="card-header">
                <i class="fa fa-bar-chart"></i>
                Programacion
              </div>
              <div class="card-body ">
                <div id="content" class="table-responsive">


                </div>

              </div>
              <div class="card-footer small text-muted">
                Updated yesterday at 11:59 PM
              </div>
      </div>

   </div>
   <div class="col-md-2">
     <div class="card mb-3">
              <div class="card-header">
                <i class="fa fa-bell-o"></i>
                Stock
              </div>
              <div class="list-group list-group-flush small">
                @foreach ($aux as  $value)


                <a href="#" class="list-group-item list-group-item-action">
                  <div class="media">

                    <div class="body">
                      <strong>{{$value['referencia']}} {{$value['desc_detalle']}}</strong><br>
                      stock disponible
                      <strong id="{{$value['id']}}">{{$value['disponibilidad']}}</strong><br>
                      <div class="text-muted smaller">Today at 5:43 PM - 5m ago</div>
                    </div>

                  </div>
                </a>
                @endforeach

              </div>
              <div class="card-footer small text-muted">
                Updated yesterday at 11:59 PM
              </div>
            </div>
   </div>
 </div>






@endsection
