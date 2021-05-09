@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-3">
            <form method="POST" action="{{ route('especialidades.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DESCRIPCION') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="espe_descrip">

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