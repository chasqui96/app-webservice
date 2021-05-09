@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <form method="post" action="{{ route('pacientes.update',$pacie->id) }}">
                {{ csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('NOMBRE') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_nombre"  value="{{$pacie->paciente_nombre}}">

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('APELLIDO') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_apellido"  value="{{$pacie->paciente_apellido}}">

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('FECHA DE NACIMIENTO') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_fecha_nac" value="{{$pacie->paciente_fecha_nac}}">

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('CEDULA') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_cedula" value="{{$pacie->paciente_cedula}}">

                            </div>
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('TELEFONO') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_telefono" value="{{$pacie->paciente_telefono}}">

                            </div>

                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('ESTADO') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="paciente_estado" value="{{$pacie->paciente_estado}}">

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