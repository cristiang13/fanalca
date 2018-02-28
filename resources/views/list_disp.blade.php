@extends('template')

@section('content')

  <div class="card" >

   <div class="card-header"> Ingresar programación de envío</div>
   <div class="card-body">

      <div style="overflow-x:auto;">

        <table   id="table_programacion"class="table compact" cellspacing="0" >

          <thead>

            <tr >
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


                                  @foreach ($arraydatos[$i] as $listado)

                                  <tr>

                                <!--  <td class="details-control" data-agencies='["agency22", "agency33","agency17","agency89"]'  width="2%"></td>-->

                                  <form id="form_entrada "class="form_entrada " action="actualizar" method="post">


                                      <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>" >
                                      <input type="hidden" id="no_doc"name="id_doc" value="{{$listado->no_doc}}">
                                      <input type="hidden" id="articulo_id"name="articulo_id" value="{{$listado->articulo_id}}">
                                      <input type="hidden" id="sucursal_id"name="sucursal_id" value="{{$listado->sucursal_id}}">
                                      <input type="hidden" id="cant_pedida"name="cant_pedida" value="{{$listado->cant_pedida}}">
                                      <input type="hidden" id="cant_pendiente"name="cant_pendiente" value="{{$listado->cant_pendiente}}">
                                      <input type="hidden" id="precio{{$listado->no_doc}}{{$listado->articulo_id}}" name="precio"  value="{{$listado->precio}}">


                                      <td id="prueba">{{$listado->no_doc}}</td>
                                      <td>{{$listado->razon_surcursal}}</td>
                                      <td>{{$listado->referencia}}</td>
                                      <td>{{$listado->desc_detalle}}</td>
                                      <td>{{$listado->cant_pedida}}</td>
                                      <td> <p id="{{$listado->no_doc}}{{$listado->articulo_id}}">{{$listado->cant_pendiente}}</p></td>
                                      <td><input type="number" class="form-control" id="cant_prog" clave="{{$listado->no_doc}}{{$listado->articulo_id}}" name="cant_prog" min="0"  required style="margin-left: 0%;"> </td>

                                      <td><input type="number" class="form-control" id="cost_proga{{$listado->no_doc}}{{$listado->articulo_id}}"  name="cost_prog"  aria-describedby="nameHelp" required style="  width:80%; margin-left: 0%;"></td>
                                      <td><input type="text" class="form-control" id="num_viaje" name="num_viaje"aria-describedby="nameHelp" required></td>
                                      <td><select class="custom-select " id="inlineFormCustomSelectPref" name="condicion_pago" style="height:26px;">
                                            <option value="1">contado</option>
                                            <option value="2">Credito 30 dias</option>
                                            <option value="3">Credito 60 dias</option>
                                            <option value="4">Credito 90 dias</option>
                                          </select>
                                      </td>
                                      <td>
                                          <input type="submit" id="update"class="btn btn-danger btn-sm "  value="ingresar"  >

                                  </form>

                                      </td>

                                    </tr>

                              @endforeach




                        @endfor


              </tbody>


        </table>

    </div>

  </div>

 </div>





 <div class="row" style="padding-top:2%;">
   <div  class="col-md-9">
    <div class="card ">
              <div class="card-header">
                <i class="fa fa-bar-chart"></i>
                Programacion
              </div>
              <div class="card-body " style="overflow-x:auto;">
                <div id="content" class="table compact" >


                </div>

              </div>

      </div>

   </div>
   <div class="col-md-3">
     <div class="card" style="background-color:white;">
              <div class="card-header" style="padding-left: 10px;">
                <i class="fa fa-motorcycle"></i>
                Stock
              </div>
              <ul class="list-group  list-group-flush small">

                @foreach ($aux as  $value)
                <li class="list-group-item "  >



                  <div class="media-body">


                      <strong>{{$value['referencia']}} {{$value['desc_detalle']}} <br></strong>

                      stock disponible:  <strong id="{{$value['id']}}" style="font-size: 18px;" >{{$value['disponibilidad']}}</strong>



                  </div>

                </li>
                @endforeach

              </ul>
      </div>
      <br>
      <div class="card" style="background-color:white;">
              <div class="card-header" style="padding-left: 10px;">
                <i class="fa fa-credit-card-alt"></i>
                Valor factura
              </div>
              <div class="list-group  small">

                @foreach ($aux_client as  $value)
                <a href="#" class="list-group-item list-group-item-action">
                  <div class="media-body">


                      {{$value['no_doc']}} <br> <strong>{{$value['sucursal']}}</strong> <br>
                      Valor factura: <strong id="{{$value['no_doc']}}">0</strong >
                  </div>
                </a>
                @endforeach

              </div>


            </div>
   </div>
 </div>

<br>




@endsection
