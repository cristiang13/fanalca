@extends('template')
@section('content')

  <h1>Articulos</h1>

   <a href="{{route('articulos.create')}}" class="btn btn-danger  btn-sm ">crear artículo</a>

   <p>

  <div class="card mb-3">

    <div class="card-body">
     <br>

      <div class="table-responsive">

        <table class="display compact"  id="usuarios"width="100%"  cellspacing="0">
          <thead>

            <tr>
              <th>Id</th>
              <th>Referencia</th>
              <th>Detalle</th>
              <th>Precio</th>
              <th></th>
              <th></th>
            </tr>
          </thead>

          <tbody>

            @foreach ($articulos as  $articulo)
              <tr>
                <td >{{$articulo->id}}</td>
                <td>{{$articulo->referencia}}</td>
                <td>{{$articulo->desc_detalle}}</td>
                <td>{{$articulo->precio_unit}}</td>
                  <td style="width:42px">
                  <a href={{route('articulos.edit',$articulo->id)}} class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  </td>
                  <td   style="width:42px">

                  {!! Form::open(['route' => ['articulos.destroy', $articulo->id], 'method' => 'DELETE']) !!}
                  <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>



                  {!! Form::close() !!}

                  </td>





              </tr>

          @endforeach




          </tbody>
        </table>
      </div>
    </div>


  </div>

@endsection
