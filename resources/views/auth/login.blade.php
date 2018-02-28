@extends('layouts.app')

@section('content')

<body style="background:#f7f7f7">
    <div  class="container" style="padding-top:5%;" >
        <div  class="row " >
            <div class="container ">
                <div class="card card-login mx-auto mt-5">
                    <div class="card-header">Iniciar sesión</div>

                    <div class="card-body">
                        <form  method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-6 control-label">Correo electrónico</label>

                                <div >
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div >
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                          <div class="form-group">
                              <div class="col-md-12" style="padding:0px">
                                  <button type="submit" class="col-12 btn btn-danger  ">
                                      Login
                                  </button>

                                  <a class="btn btn-link" style="padding-left:0px"href="{{ route('password.request') }}">
                                    Olvidaste tu contraseña?
                                  </a>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>
@endsection
