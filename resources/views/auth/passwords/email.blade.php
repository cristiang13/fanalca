@extends('layouts.app')

@section('content')
<body style="background:#f7f7f7">

 <div class="container" style="padding-top: 5%; ">

    <div class="row">

          <div class="container col-sm-6 ">

            <div class="card   mx-auto mt-5">
                <div class="card-header">Restablecer contraseña</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          <div class="row">


                            <label for="email" class="col-md-4 control-label text-center">Correo Electrónico</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="text-center col-md-12 col-md-offset-4">
                                <button type="submit" class="btn btn-danger ">
                                  Enviar contraseña
                                </button>
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
