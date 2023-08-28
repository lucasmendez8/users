@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Nuevo Permiso</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('permisos.store', ['modulo' => $modulo]) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="modulo" class="form-label">Módulo</label>
                                <input type="text" class="form-control" disabled value="{{ $modulo->nombre }}" />
                                <input type="hidden" name="modulo_id" value="{{ $modulo->id }}" />
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" id="nombre" name="nombre" class="form-control  @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}">
                                @if($errors->has('nombre'))
                                    <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="nombre_corto" class="form-label">Nombre Corto</label>
                                <input type="text" id="nombre_corto" name="nombre_corto" class="form-control @error('nombre_corto') is-invalid @enderror" value="{{ old('nombre_corto') }}">
                                @if($errors->has('nombre_corto'))
                                    <div class="invalid-feedback">{{ $errors->first('nombre_corto') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="activo" class="form-label">Activo</label>
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" />
                            </div>

                            <button type="submit" class="btn btn-primary" onclick="send(this)">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
