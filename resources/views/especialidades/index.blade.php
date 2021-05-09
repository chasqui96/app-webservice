@extends('layouts.app')

@section('content')
    <H1>BIENVENIDOS</H1>

    <a class="nav-link " href="{{ route('especialidades.create') }}" >{{ __('ir a formulario') }}</a>
    @include('especialidades.info') 

    <div class="content p-3">
     <div class="card p-3">
     <table class="table table-bordered">
    <thead>
    <tr>
    <th>ID</th>
    <th>DESC</th>
    <th>ACCION</th>
    </tr>
    </thead>
    <tbody>
    @foreach($espe as $e)

    <tr>
    <td>{{$e->id}}</td>
    <td>{{$e->espe_descrip}}</td>
    <td> <a  href="{{route('especialidades.edit',$e->id)}}" class="btn btn-info"><i class="fa fa-pencil"></i> Editar</a> <a href="{{route('especialidades.destroy',$e->id)}}" class="btn btn-danger"><i class="fa fa-pencil"></i> Eliminar</a></td>
    </tr>

    @endforeach
    </tbody>
    </table>
     </div>
   
    </div>
    
 @endsection