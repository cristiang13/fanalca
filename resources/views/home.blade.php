@extends('welcome')

@section('content')
<div class="container">
    <div class="row">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                  <a style="font-size:35px"> Tu estas logeado!</a>


    </div>
</div>
@endsection
