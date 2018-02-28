@extends('template')
@section('content')

  <div class="row">

    <div class="col-md-3">

    </div>

  <div class=" col-md-5 " >
 <h1>Articulo</h1>
 <hr>

 {!! Form::open(array('route' => 'articulos.store', 'method' => 'POST')) !!}

 {!! Form::label('Referencia', 'referencia') !!}
 {!! Form::text('referencia', null, ['class' => 'form-control']) !!}

 {!! Form::label('Descripcion', 'descripcion') !!}
 {!! Form::text('desc_detalle', null, ['class' => 'form-control']) !!}

 {!! Form::label('Precio', 'precio') !!}
 {!! Form::text('precio_unit', null, ['class' => 'form-control']) !!}

 <br>
 {{ Form::submit('Crear', array('class' => 'btn btn-danger')) }}

{!! Form::close() !!}



</div>
<div class="col-md-3">

</div>

  </div>
@endsection
