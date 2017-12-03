<!DOCTYPE html>
<html lang="en">

  <head>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!-- Styles -->
    <style>
    .navbar {

      background-color: #fff;
      color: #636b6f;
      font-family: 'Open_sans', sans-serif;

     }
     .card {

       background-color: black;
       color: black;
       font-family: 'Open_sans', sans-serif;

      }
     .full-height {
         height: 89vh;
     }

     .flex-center {
         align-items: center;
         display: flex;
         justify-content: center;
     }



     .top-right {
         position: absolute;
         right: 10px;
         top: 18px;
     }

     .content {
         text-align: center;

     }

     .title {
         font-size: 84px;
     }

     .links > a {
         color: #636b6f;
         padding: 0 25px;
         font-size: 12px;
         font-weight: 600;
         letter-spacing: .1rem;
         text-decoration: none;
         text-transform: uppercase;
     }

     .m-b-md {
         margin-bottom: 10px;
     }

        .blancoOpacityNav {

           background: rgba(255, 255, 255, 0.9);
           width: 100%;
           height: 60px;
           position: relative;
          }

        .full-height {
            height: 90vh;
        }

        .body{
          background-color: #f7f7f7;
        }

        #cant_prog{
          width:50%;
          margin-left: 15%


        }

        .size{
            width:50%;
            margin-left: 2%;
        }

        #num_viaje{

      width:70%;

        }


    </style>
  <style type="text/css">

  td.details-control {
      background: url("{{asset("img/details_open.png")}}") no-repeat center center;
      cursor: pointer;
  }
  tr.shown td.details-control {
      background: url("{{asset("img/details_close.png")}}") no-repeat center center;
  }
</style>


    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="">
    <meta name="author" content="">
    <title >Programacion de viajes </title>

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

  </head>

  <body  id="page-top" class=" fixed-nav sticky-footer" style="background-color:#f7f7f7">

    <!-- Navigation -->


    <nav class="navbar navbar-expand-lg navbar-dark fixed-top " style=" width: 100%; background-color: rgba(38,39,39,0.9);padding-top:0px;padding-bottom:0px">

    <a class="navbar-brand" style="padding-top:0px;padding-bottom:0px" href="/welcome">
      <img src="{{asset("img/logo.jpg")}}"  style="width: 173px; height: 60px;" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
      <ul class="navbar-nav mr-auto">
        <li class="nav-item ">
          <a class="nav-link" href="{{ url('/import/disponibilidad') }}">Importar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/cupos')}}">Créditos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/stock')}}">Stock</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/detpedidos') }}">Datos</a>
        </li>
        <li class="nav-item ">
          <a class="nav-link" href="{{url('/progviaje')}}">Programación</a>
        </li>



      </ul>

     <ul class="navbar-nav ml-auto">
       <li class="nav-item dropdown" style="width:158px;">

          <a class="nav-link dropdown-toggle"   data-toggle="dropdown" >
              {{ Auth::user()->first_name }}
          </a>
         <div class=" dropdown-menu ">
          <a class="navbar-link" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
            <i class="fa fa-fw fa-sign-out"></i>
            cerrar sesión</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>

        </div>
       </li>

     </ul>


    </div>
  </nav>



 <div class="container-fluid">
   <!-- animacion cargador  -->
 <div style="display: none;" id="cargador_empresa" align="center">
     <br>


  <label style="color:#FFF; background-color:#ABB6BA; text-align:center">&nbsp;&nbsp;&nbsp;Espere... &nbsp;&nbsp;&nbsp;</label>

  <img src="{{ url('/img/cargando.gif') }}" align="middle" alt="cargador"> &nbsp;<label style="color:#ABB6BA">Cargando datos espere un momento por favor ...</label>

   <br>

  <br>
</div>
<div class="row">
  <div class="col-md-1">

  </div>
  <div class="col-md-10" style="padding-top:50px;">
    @yield('content')
  </div>
  <div class="col-md-1">

  </div>




 </div>

 <div class="row">


  <footer class="sticky-footer" style="width:100%" >
    <div class="container">
      <div class="text-center">
        <small class="links">Copyright &copy; proyecto ADSI107 2017 </small>
      </div>
    </div>
  </footer>

  </div>
  <!-- Scroll to Top Button -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>
    <!-- Bootstrap core JavaScript -->
    <script src={{asset("js/bootstrap.min.js")}}></script>
    <script src={{asset("template/vendor/jquery/jquery-1.12.4.js")}}></script>
    <script src={{asset("template/vendor/jquery/jquery.min.js")}}></script>
    <script src={{asset("template/vendor/popper/popper.min.js")}}></script>
    <script src={{asset("template/vendor/bootstrap/js/bootstrap.min.js")}}></script>

    <!-- Plugin JavaScript -->
    <script src={{asset("template/vendor/jquery-easing/jquery.easing.min.js")}}></script>
    <script src={{asset("template/vendor/chart.js/Chart.min.js")}}></script>
    <script src={{asset("template/vendor/datatables/jquery.dataTables.js")}}></script>
    <script src={{asset("template/vendor/datatables/jquery.dataTables.min.js")}}></script>



    <!-- Custom scripts for this template -->
      <script src={{asset("template/js/dataTables.min.js")}}></script>
    <script src={{asset("template/js/import_csv.js")}}></script>
    <script src={{asset("template/js/sb-admin.min.js")}}></script>

    <!-- script smoke plugin para notificaciones,alertas,etc -->
    <script src={{asset("smokejs/dist/js/smoke.min.js")}}></script>
    <!-- script lenguae smoke plugin para notificaciones,alertas,etc -->
    <script src={{asset("smokejs/dist/lang/es.min.js")}}></script>

  </body>

</html>
