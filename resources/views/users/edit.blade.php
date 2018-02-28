@extends('template')
@section('content')

  <div class="row">

    <div class="col-md-3">

    </div>

  <div class=" col-md-5 " >
 <h1>Perfil de usuario</h1>
 @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
 <hr>
@foreach ($user as $user)

  {!! Form::open(array('route' => array('users.update', $user->id), 'method' => 'PATCH')) !!}

 {!! Form::label('nombre1', 'Primer nombre') !!}
 {!! Form::text('first_name', $user->first_name, ['class' => 'form-control']) !!}

 {!! Form::label('nombre2','segundo nombre') !!}
 {!! Form::text('last_name', $user->last_name, ['class' => 'form-control']) !!}

 {!! Form::label('apellido1','primer apellido') !!}
 {!! Form::text('first_lastname', $user->first_lastname, ['class' => 'form-control']) !!}

 {!! Form::label('apellido2','segundo apellido') !!}
 {!! Form::text('last_lastname', $user->last_lastname, ['class' => 'form-control']) !!}

 {!! Form::label('cellphone','numero celular') !!}
 {!! Form::text('cellphone', $user->cellphone, ['class' => 'form-control']) !!}

 {!! Form::label('email','correo electrónico') !!}
 {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}

 <br>

 <input type="submit" class="btn btn-danger" name="submit" value="Actualizar">

{!! Form::close() !!}

@endforeach

</div>
<div class="col-md-3">

</div>

  </div>
@endsection
