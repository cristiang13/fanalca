@extends('layouts.app')

@section('content')
  <body style="background:#f7f7f7">

  <div class="container" style="padding-top: 5%;" >

    <main>

<div class="container">
    <div class="row">
       <div class="col-md-2">

       </div>
        <div class="col-md-8 ">
            <div class="panel card">
                <div class="card-header">Registrar</div>

                <div class="card-body">
                    <form  method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                      <div class="form-row">
                        <div class="form-group{{ $errors->has('dni') ? ' has-error' : '' }} col-md-6">
                            <label for="name" class=" control-label">Numero de documento</label>


                                <input id="dni" type="text" class="form-control" name="dni" value="{{ old('dni') }}" required autofocus>

                                @if ($errors->has('dni'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('dni') }}</strong>
                                    </span>
                                @endif

                        </div>

                      </div>
                      <div class="form-row">

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} col-md-6">
                            <label for="name" class=" control-label">Primer nombre</label>
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }} col-md-6">
                            <label for="last_name" class="control-label">Segundo nombre</label>
                            <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}"  autofocus>
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                   </div>
                   <div class="form-row">
                        <div class="form-group{{ $errors->has('first_lastname') ? ' has-error' : '' }} col-md-6">
                            <label for="first_lastname" class="control-label">Primer apellido</label>
                            <input id="first_lastname" type="text" class="form-control" name="first_lastname" value="{{ old('first_lastname') }}" required autofocus>
                                @if ($errors->has('first_lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_lastname') }}</strong>
                                    </span>
                                @endif

                        </div>

                        <div class="form-group{{ $errors->has('last_lastname') ? ' has-error' : '' }} col-md-6">
                            <label for="last_lastname" class="control-label">Segundo apellido</label>
                            <input id="last_lastname" type="text" class="form-control" name="last_lastname" value="{{ old('last_lastname') }}"  autofocus>
                                @if ($errors->has('last_lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_lastname') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class=" form-row">

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} col-md-6">
                            <label for="email" class="control-label">Correo electrónico</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('cellphone') ? ' has-error' : '' }} col-md-6">
                            <label for="cellphone" class="control-label">Telefono celular</label>
                            <input id="cellphone" type="text" class="form-control" name="cellphone" value="{{ old('cellphone') }}" required>
                                @if ($errors->has('cellphone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-row">
                      <div class="form-group col-md-2">

                          <label for="email" class="control-label" style="margin-bottom:5px;">Cargo</label>
                          <br>
                          <select class="custom-select my-1 mr-sm-2 " id="inlineFormCustomSelectPref" name="role" data-width="auto">
                           <option value="programador" selected>Programador</option>
                           <option  value="administrador" disabled >Administrador</option>

                         </select>
                      </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} col-md-5">
                            <label for="password" class="control-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group col-md-5">
                            <label for="password-confirm" class="control-label">Confirmar Password</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>

                  </div>
                  <div class="form-row">
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                          <button type="submit" class="btn btn-primary">
                                      Registrar usuario
                        </button>
                       </div>
                   </div>
                  </div>

             </form>
          </div>
      </div>
     </div>
   </div>
 </main>
</div>
</body>
@endsection
