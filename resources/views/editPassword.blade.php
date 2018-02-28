@extends('template')
@section('content')
<div class="row">
  <div class="col-md-3">

  </div>

<div class=" col-md-5 " >

  <h1>Cambiar mi password</h1>
      @if (Session::has('status'))
        <hr/>
        <div class='text-success'>
            {{Session::get('status')}}
        </div>

    @endif
    @if (Session::has('message'))
     <div class="text-danger">
     {{Session::get('message')}}
     </div>
    @endif
    <hr/>
<form method="post" action="{{ url('/users/updatePassword') }}" >
 {{csrf_field()}}
 <div class="form-group">
  <label for="mypassword">Introduce tu actual password:</label>
  <input type="password" name="mypassword" class="form-control">
  <div class="text-danger">{{$errors->first('mypassword')}}</div>
 </div>
 <div class="form-group">
  <label for="password">Introduce tu nuevo password:</label>
  <input type="password" name="password" class="form-control">
  <div class="text-danger">{{$errors->first('password')}}</div>
 </div>
 <div class="form-group">
  <label for="mypassword">Confirma tu nuevo password:</label>
  <input type="password" name="password_confirmation" class="form-control">
 </div>
 <button type="submit" class="btn btn-danger">Cambiar mi password</button>
</form>

</div>
</div>

@endsection
