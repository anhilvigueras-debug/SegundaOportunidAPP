@extends('layouts.app')
@section('content')<div class="col-lg-7 mx-auto"><h1>Editar publicación</h1><form method="POST" action="{{ route('publicaciones.update',$publicacion) }}">@include('publicaciones._form')</form></div>@endsection
