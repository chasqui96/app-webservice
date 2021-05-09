@extends('layouts.app')

@section('content')
    <H1>BIENVENIDOS</H1>

    <a class="nav-link " href="{{ route('personales.create') }}" >{{ __('ir a formulario') }}</a>
    @include('personales.info') 

    <div class="content p-3">
     <div class="card p-3">
     <table class="table table-bordered">
    <thead>
    <tr>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>APELLIDO</th>
    <th>CEDULA</th>
    <th>TELEFONO</th>
    <th>TIPO DE PERSONA</th>
    <th>USUARIO</th>
    <th>CONTRASEÑA</th>
    <th>NIVEL</th>
    <th>ESTADO</th>
    <th>ACCION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($per as $e)

    <tr>
    <td>{{$e->id}}</td>
    <td>{{$e->per_nombre}}</td>
    <td>{{$e->per_apellido}}</td>
    <td>{{$e->per_cedula}}</td>
    <td>{{$e->per_telefono}}</td>
    <td>{{$e->tipo_persona}}</td>
    <td>{{$e->user}}</td>
    <td>{{$e->pass}}</td>
    <td>{{$e->nivel}}</td>
    <td>{{$e->per_estado}}</td>
     <td> <a  href="{{route('personales.edit',$e->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a> <a href="{{route('personales.destroy',$e->id)}}" class="btn btn-danger"><i class="fa fa-pencil"></i> Eliminar</a>  <a href="{{route('personales.cambiar',$e->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Cambiar Estado</a></td>
    </tr>

    @endforeach
    </tbody>
    </table>
     </div>
   
    </div>
    bai
 @endsection