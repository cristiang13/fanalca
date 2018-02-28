<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap core CSS -->


    <link href={{asset("template/vendor/bootstrap/css/bootstrap.min.css")}} rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href={{asset("template/vendor/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->

    <link href={{asset("template/vendor/datatables/jquery.dataTables.min.css")}} rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href={{asset("template/css/sb-admin.css")}} rel="stylesheet">

    <!-- smoke plugin para notificaciones,alertas,etc -->
    <link href="{{asset("smokejs/dist/css/smoke.min.css")}}" rel="stylesheet">

    <!-- Styles original-->








    <!-- Styles -->

    <style>



  .navbar {

    background-color: #fff;
    color: #636b6f;
     font-family: 'Open_sans', sans-serif;

   }

   body{
      font-family: 'Open_sans', sans-serif;
   }

  main {
   flex: 1 0 auto;
  }



  /* label focus color */
  .input-field input:focus + label {
    color: gray !important;
  }



     .row .input-field input:focus {
        border-bottom: 1px solid gray !important;
        box-shadow: 0 1px 0 0 #EEEEEE !important
      }


    </style>


</head>
<body>
    <div id="app" >
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top " style=" width: 100%; background-color: rgba(38,39,39,0.9);padding-top:0px;padding-bottom:0px">

      <a class="navbar-brand" style="padding-top:0px;padding-bottom:0px" href="/">
        <img src="{{asset("img/logo.jpg")}}"  style="width: 173px; height: 60px;" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @if (Auth::guest())

    <!--  <div class="collapse navbar-collapse " id="navbarSupportedContent" >

          <ul class="navbar-nav mr-auto" style="padding-left:75%;">

            <li class="nav-item">
              <a class="nav-link" href="{{ route('login') }}">iniciar&nbsp;sesion</a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="{{ route('register') }}">registrar</a>
            </li>

          </ul>
      </div>-->
      @else

       <div class="collapse navbar-collapse " id="navbarSupportedContent1" >
            <ul class="navbar-nav ml-md-auto d-none d-md-flex" >

              <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle mr-md-2" href="{{ route('login') }}" data-toggle="dropdown" aria-expanded="true" aria-haspopup="true">{{ Auth::user()->first_name }} <span class="caret"></span></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
                  <a class="dropdown-item "href="{{ route('home') }}">
                      menu principal
                  </a>
                    <a class="dropdown-item "href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();" >Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>

                  </div>
              </li>
            </ul>
      </div>


      @endif



    </nav>


        @yield('content')
    </div>

    <!-- Scripts -->


    <script src={{asset("template/vendor/jquery/jquery.min.js")}}></script>
   <script src={{asset("template/js/materialize.min.js")}}></script>



    <script src={{asset("js/bootstrap.min.js")}}></script>
    <script src={{asset("template/vendor/jquery/jquery-1.12.4.js")}}></script>
    <script src={{asset("template/vendor/jquery/jquery.min.js")}}></script>
    <script src={{asset("template/vendor/popper/popper.min.js")}}></script>
    <script src={{asset("template/vendor/bootstrap/js/bootstrap.min.js")}}></script>


  <!--  <script>
      $(document).ready(function(){
          $("#foco").mouseenter(function(){
              $("#foco").css("color", "#FFFFFF");
          });
          $("#foco").mouseleave(function(){
              $("#foco").css("color", "#ffffff80");
          });
      });
    </script>-->
</body>
</html>
