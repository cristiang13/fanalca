@extends('template')
@section('content')

  <div class="row">

    <div class="col-md-3">

    </div>

  <div class=" col-md-5 " >
 <h1>Articulo</h1>
 <hr>
@foreach ($articulo as $articulo)

  {!! Form::open(array('route' => array('articulos.update', $articulo->id), 'method' => 'PATCH')) !!}

 {!! Form::label('referencia', 'Referencia') !!}
 {!! Form::text('referencia', $articulo->referencia, ['class' => 'form-control']) !!}

 {!! Form::label('detalle','Detalle') !!}
 {!! Form::text('detalle', $articulo->desc_detalle, ['class' => 'form-control']) !!}

 {!! Form::label('precio','Precio') !!}
 {!! Form::text('precio', $articulo->precio_unit, ['class' => 'form-control']) !!}


 <br>

 <input type="submit" class="btn btn-danger" name="submit" value="Actualizar">

{!! Form::close() !!}

@endforeach

</div>
<div class="col-md-3">

</div>

  </div>
@endsection
