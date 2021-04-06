@extends('layouts.app')

@section('content')
    <H1>BIENVENIDOS</H1>

    <a class="nav-link " href="{{ route('pacientes.create') }}" >{{ __('ir a formulario') }}</a>
    @include('pacientes.info') 

    <div class="content p-3">
     <div class="card p-3">
     <table class="table table-bordered">
    <thead>
    <tr>
    <tr>
    <th>ID</th>
    <th>NOMBRE</th>
    <th>APELLIDO</th>
    <th>FECHA NACIMIENTO</th>
    <th>CEDULA</th>
    <th>TELEFONO</th>
    <th>ESTADO</th>
    <th>ACCION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pacie as $e)

    <tr>
    <td>{{$e->id}}</td>
    <td>{{$e->paciente_nombre}}</td>
    <td>{{$e->paciente_apellido}}</td>
    <td>{{$e->paciente_fecha_nac}}</td>
    <td>{{$e->paciente_cedula}}</td>
    <td>{{$e->paciente_telefono}}</td>
    <td>{{$e->paciente_estado}}</td>
     <td> <a  href="{{route('pacientes.edit',$e->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a> <a href="{{route('pacientes.destroy',$e->id)}}" class="btn btn-danger"><i class="fa fa-pencil"></i> Eliminar</a>  <a href="{{route('pacientes.cambiar',$e->id)}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Cambiar Estado</a></td>
    </tr>

    @endforeach
    </tbody>
    </table>
     </div>
   
    </div>
    bai
 @endsection