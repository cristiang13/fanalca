@extends('template')
@section('content')
  <div class="row">
    <div class="col-md-2">

    </div>

  <div class="col-md-8" style="padding-top:90px">

<div class="card mb-3">
  <div class="card-header ">
    <h4>Cargar Datos</h4>
  </div><!-- /.box-header -->

      <div class="card-body  ">


      <div id="notificacion_resul_fcdu" ></div>

      <form  id="cargar_file_dispo"  class="formarchivo" action="cargar_file_dispo" method="post" enctype="multipart/form-data">

        <input type="hidden" name="_token" id="_token"  value="<?= csrf_token(); ?>">

              <div>
                     <label> </label>

                      <input name="archivo" id="carga_archivo" type="file"   class="archivo form-control"  required/><br /><br />
              </div>

        <input type="submit"class="btn btn-danger  btn-sm"  value="importar">

      </form>

      </div>
    

  </div>
</div>
<div class="col-md-2">

</div>
</div>
@endsection
