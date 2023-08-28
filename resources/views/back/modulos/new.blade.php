@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Nuevo Módulo</h1>
        <div class="row">
            <div class="col">
                <form action="{{ route('modulos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre') }}" />
                        @if($errors->has('nombre'))
                            <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="activo" class="form-label">Activo</label>
                        <input type="checkbox" class="form-check-input" id="activo" name="activo" />
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" onclick="send(this)">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
