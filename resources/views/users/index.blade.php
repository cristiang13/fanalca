@extends('template')
@section('content')


  <h1>Usuarios</h1>
    @if (session('msg'))
        @if (session('msg')=='Usuario registrado')
          <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>
        @else
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            usuario no registrado
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

        @endif
    @endif

   <a href="{{route('register')}}" class="btn btn-danger  btn-sm ">registrar usuario</a>

   <p>


  <div class="card mb-3">



    <div class="card-body">



      <div class="table-responsive">

        <table class="table compact"  id="usuarios"width="100%"  cellspacing="0">
          <thead>

            <tr>
              <th>No. identificación</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Corre electrónico</th>
              <th>Número telefónico</th>
              <th></th>
              <th></th>

            </tr>
          </thead>

          <tbody>

            @foreach ($users as  $users)
              <tr>
                <td >{{$users->dni}}</td>
                <td>{{$users->first_name}}
                  @if ($users->last_name != 'null')
                    {{$users->last_name}}
                  @endif
                </td>
                <td>{{$users->first_lastname}}
                  @if ($users->last_lastname != 'null')
                    {{$users->last_lastname}}
                  @endif
                </td>
                <td>{{$users->email}}</td>
                <td>{{$users->cellphone}}</td>

                  <td style="width:42px">
                  <a href={{route('users.edit',$users->id)}} class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  </td>
                  <td   style="width:42px">

                  {!! Form::open(['route' => ['users.destroy', $users->id], 'method' => 'DELETE']) !!}
                  <button class="btn btn-danger" type="submit"><i class="fa fa-trash-o" aria-hidden="true" ></i></button>

                  {!! Form::close() !!}

                  </td>





              </tr>

          @endforeach




          </tbody>
        </table>
      </div>
    </div>


  </div>

@endsection
