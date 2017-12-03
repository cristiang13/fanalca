@extends('layouts.app')

@section('content')
  <head>
    <meta charset="utf-8">

    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">


    <title></title>
  </head>
<body style="background:#f7f7f7">


  <div class="container" style="padding-top: 5%;" >

    <main>


        <div class="container">

                    <div class="card card-login mx-auto mt-5 " style="background: #ffffff; ">
                      <div class="card-body">
                        <div class="card-title">
                          <h4> <center>Honda/fanalca</center></h4>
                        </div>
                        <br>

                        <form  role="form" method="POST" action="{{ url('/login') }}">
                          {{ csrf_field() }}

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" style="text-align:right;">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="correo electrónico" value=" {{ old('email') }}">
                            @if ($errors->has('email'))
                              <span class="help-block ">
                                <a style="color:red;">{{ $errors->first('email') }}</a>
                              </span>
                            @endif
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="contraseña">

                            @if ($errors->has('password'))
                              <span class="help-block">
                                <a style="color:red;">{{ $errors->first('password') }}</a>
                              </span>
                            @endif

                          </div>
                          <div class="form-check">
                            <a href="/password/email" class="card-link">Recuperar contraseña(forget password)</a>
                          </div>
                          <br>

                          <button type="submit" class="btn btn-danger btn-lg btn-block btn-sm">Iniciar sesión</button>

                        </div>

                    </div>

                    </form>


        </div>

          <!--  <div class="container" >
              <div class="card card-login mx-auto mt-5">
                <div class="card-header">
                Iniciar sesion
                </div>
                <div class="card-body">

            <form  role="form" method="POST" action="{{ url('/login') }}">
              {{ csrf_field() }}




              <div class="input-field form-group{{ $errors->has('email') ? ' has-error' : '' }}">



                  <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}">
                  <label for='email'>Ingrese email</label>
                  @if ($errors->has('email'))
                    <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                    </span>
                  @endif
                </div>





              <div class="input-field form-group{{ $errors->has('password') ? ' has-error' : '' }}">




                  <input id="password" type="password" class="form-control" name="password">
                  <label for="password">Ingrese contraseña</label>

                  @if ($errors->has('password'))
                    <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                    </span>
                  @endif




              </div>
              <div class="row">
                <a class='pink-text' href="/password/email"><b>recuperar contraseña (forget password)</b></a>
              </div>





              <div class="input-field form-group">
                <div class="row">
                  <button type="submit" class='col s12 btn-alert btn-large waves-effect red darken-1 '>
                    Iniciar Sesion
                  </button>

                </div>
              </div>

            </form>
          </div>
        </div>

</div>-->



</main>
  </div>
</body>

<!--  <body>


<div class="container">
  <main>
    <center>



      <div class="section" ></div>

      <div class="container" style="margin-top: 5%">
        <div class="z-depth-1 card medium lighten-4 row" style=" display: inline-block; padding: 32px 48px 0px 48px; background-color: rgba(255,253,255,0.8);">

          <form class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' />
                <label for='email'>Ingrese email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' />
                <label for='password'>Ingrese contraseña</label>
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='#!'><b>recuperar contraseña</b></a>
							</label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='btn_login' class='col s12 btn-alert btn-large waves-effect red darken-1 '>Iniciar sesion</button>
              </div>
            </center>
          </form>
        </div>
      </div>

    </center>


  </main>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>-->
@endsection
