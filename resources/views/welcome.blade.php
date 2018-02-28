
  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <!-- Materialize -->

      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

      <!-- Styles -->
      <style>
          html {
              color: #636b6f;
              font-family: 'Raleway', sans-serif;
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







   body {
      background-image: url("{{asset("img/background-general-honda.jpg")}}");
     background-size: auto;
      background-repeat: no-repeat;

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
      <title></title>
    </head>
    <body>

  <main>


    <center>

      <div class="link" style="padding-top:5%" >
        @yield('content')
      </div>

       <div class="content col-xs-1" align="center" style="padding-top:500px;height:100px">
                <div class="title">
                    FANALCA|HONDA
                </div>

                <div class="links ">

                   <a href="{{ url('/detpedidos') }}">datos</a>
                   <a href="{{url('/stock')}}">Stock</a>
                   <a href="{{url('/cupos')}}">Credito</a>
                    <a href="{{url('/progviaje')}}">Programacion Viajes</a>
                    <a href="{{ url('/import/disponibilidad') }}">importar</a>

                </div>
            </div>

                </center>
              </main>

        <script src={{asset("template/vendor/jquery/jquery.min.js")}}></script>
      <script src={{asset("template/js/materialize.min.js")}}></script>
      </body>

    </html>
