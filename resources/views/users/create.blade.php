@extends('template')
@section('content')

  <div class="row">

    <div class="col-md-2">

    </div>

  <div class=" col-md-8 " >
 <h1>Usuario</h1>
 <hr>

    {!! Form::open(array('route' => 'users.store', 'method' => 'POST')) !!}
      {{ csrf_field() }}
           <div class="form-row">
             <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }} col-md-6">
                 <label for="name" class=" control-label">Numero de documento</label>
                 <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required autofocus>
                     @if ($errors->has('dni'))
                       @php
                         $alert='número de documento ya está en uso';
                       @endphp
                      @include('mensajes.alertas', ['alert' => $alert])
                     @endif
             </div>
           </div>

           <div class="form-row">
             <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                 <label for="name" class=" control-label">Primer nombre</label>
                     <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                     @if ($errors->has('first_name'))
                       @php
                         $alert=$errors->first('first_name');
                       @endphp
                      @include('mensajes.alertas', ['alert' => $alert])
                     @endif
             </div>

             <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} col-md-6">
                 <label for="last_name" class="control-label">Segundo nombre</label>
                 <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  autofocus>
                 @if ($errors->has('last_name'))
                   @php
                     $alert=$errors->first('last_name');
                   @endphp
                  @include('mensajes.alertas', ['alert' => $alert])
                 @endif
             </div>
           </div>

           <div class="form-row">
             <div class="form-group{{ $errors->has('first_lastname') ? ' has-error' : '' }} col-md-6">
                 <label for="first_lastname" class="control-label">Primer apellido</label>
                 <input id="first_lastname" type="text" class="form-control" name="first_lastname" value="{{ old('first_lastname') }}" required autofocus>
                 @if ($errors->has('first_lastname'))
                   @php
                     $alert=$errors->first('first_lastname');
                   @endphp
                  @include('mensajes.alertas', ['alert' => $alert])
                 @endif

             </div>

             <div class="form-group{{ $errors->has('last_lastname') ? ' has-error' : '' }} col-md-6">
                 <label for="last_lastname" class="control-label">Segundo apellido</label>
                 <input id="last_lastname" type="text" class="form-control" name="last_lastname" value="{{ old('last_lastname') }}"  autofocus>
                 @if ($errors->has('last_lastname'))
                   @php
                     $alert=$errors->first('last_lastname');
                   @endphp
                  @include('mensajes.alertas', ['alert' => $alert])
                 @endif
             </div>
           </div>



           <div class="form-row">
             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
                 <label for="email" class="control-label">Correo electrónico</label>
                 <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                 @if ($errors->has('email'))
                   @php
                     $alert=$errors->first('email');
                   @endphp
                  @include('mensajes.alertas', ['alert' => $alert])
                 @endif
             </div>

             <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }} col-md-6">
                 <label for="cellphone" class="control-label">Telefono celular</label>
                 <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required>
                 @if ($errors->has('cellphone'))
                   @php
                     $alert=$errors->first('cellphone');
                   @endphp
                  @include('mensajes.alertas', ['alert' => $alert])
                 @endif
             </div>
           </div>

           <div class="form-row">
             <div class="form-group col-md-2">

                 <label for="email" class="control-label" style="margin-bottom:5px;">Cargo</label>
                 <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="role">
                  <option value="programador" selected>Programador</option>
                  <option  value="administrador" disabled >Administrador</option>

                </select>
             </div>
             <div class="col-md-5">
               <label for="password" class="control-label">Password</label>
               <input id="password" type="password" class="form-control" name="password" required>
               @if ($errors->has('password'))
                 @php
                   $alert=$errors->first('password');
                 @endphp
                @include('mensajes.alertas', ['alert' => $alert])
               @endif
             </div>
             <div class="col-md-5">
               <label for="password-confirm" class="control-label">Confirmar Password</label>
               <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

             </div>

           </div>

 <br>
 {{ Form::submit('Registrar', array('class' => 'btn btn-danger')) }}

{!! Form::close() !!}



</div>
<div class="col-md-2">

</div>

  </div>
@endsection
