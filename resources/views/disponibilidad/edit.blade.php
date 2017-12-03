@extends('home')
@section('content')
  <div class="card card-register mx-auto mt-5">
          <div class="card-header">
            Ingresar programación de viaje
          </div>
          <div class="card-body">
              <div id="notificacion_resul_fcdu" ></div>
            @foreach ($datos as $value)
                @php
                  $no_doc=$value->no_doc;
                  $arti_id=$value->articulo_id;
                  $suc_id=$value->sucursal_id;

                @endphp

            <h4 class="card-title">{{ $value->razon_surcursal}}</h4>
             <h6 class="card-subtitle mb-2 text-muted"> {{$value->no_doc}} </h6>


                    <div id="accordion" role="tablist">

                        <a data-toggle="collapse" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                          detalle de disponibilidad
                        </a>


                    <div id="collapseOne" class="collapse " role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">

                      <p class="card-text">-cantidad pedida: {{$value->cant_pedida}} <br>
                                      -cantidad pendiente: {{$value->cant_pendiente}}  <br> - referencia: {{$value->referencia}}/ {{ $value->desc_detalle}}<br>
                                    -precio unitario {{$value->precio}}<br> -- disponibilidad real {{$dispo}}  </p>
                    </div>
                  </div>
                    @endforeach
                  <form id="insertar_prog"  method="post"  action="{{ route('detpedidos.completar') }}" >
             <div class="form-group">
               <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">
               <input type="hidden" id="no_doc"name="id_doc" value="{{$no_doc}}">
               <input type="hidden" id="articulo_id"name="articulo_id" value="{{$arti_id}}">
               <input type="hidden" id="sucursal_id"name="sucursal_id" value="{{$suc_id}}">
               <input type="hidden" id="precio_unit"name="precio_unit" value="{{$value->precio}}">
               <input type="hidden" id="dispo"name="dispo" value="{{$dispo}}">


               <div class="form-row">
                 <div class="col-md-6">
                   <label for="cant_prog">Cantidad Programada</label>
                   <input type="text" class="form-control" id="cant_prog" name="cant_prog"aria-describedby="nameHelp" >
                 </div>

                 <div class="col-md-6">
                   <label for="cost_prog">Costo Programado</label>
                   <input type="text" class="form-control" id="cost_proga" name="cost_prog"  aria-describedby="nameHelp">
                 </div>
               </div>
             </div>

             <div class="form-group">
               <div class="form-row">

               <div class="col-md-6">
                 <label for="num_viaje">Numero de viaje</label>
                 <input type="text" class="form-control" id="num_viaje" name="num_viaje"aria-describedby="nameHelp">
               </div>
               <div class="col-md-6">
                 <label class="mr-sm-2" >Condicion de pago</label><br>
                     <select class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelectPref" name="condicion_pago">
                       <option selected value="0">seleccionar...</option>
                       <option value="1">contado</option>
                       <option value="2">Credito 30 dias</option>
                       <option value="3">Credito 60 dias</option>
                       <option value="3">Credito 90 dias</option>
                     </select>


               </div>
               </div>
             </div>


             <button type="submit" class="btn btn-primary btn-block btn-sm">Ingresar datos</button>

           </form>


      </div>
  </div>



@endsection
