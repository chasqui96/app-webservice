@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <form method="post" action="{{ route('personales.update',$per->id) }}">
                        @csrf

                        <div class="form-group row">

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('NOMBRE') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="per_nombre" value="{{$per->per_nombre}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('APELLIDO') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="per_apellido" value="{{$per->per_apellido}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CEDULA') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="per_cedula" value="{{$per->per_cedula}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TELEFONO') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="per_telefono" value="{{$per->per_telefono}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TIPO DE PERSONA') }}</label>
                            <div class="col-md-6">
                                 <input id="name" type="text" class="form-control" name="tipo_persona" value="{{$per->tipo_persona}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('USUARIO') }}</label>
                            <div class="col-md-6">
                                 <input id="name" type="text" class="form-control" name="user" value="{{$per->user}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CONTRASEÑA') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="pass" value="{{$per->pass}}">
                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('NIVEL') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="nivel" value="{{$per->nivel}}">
                            </div>

                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('GUARDAR') }}
                                </button>
                            </div>
                        </div>
                    </form>
             
            </div>
        </div>
    </div>
</div>
@endsection