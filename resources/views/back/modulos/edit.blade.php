@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Editar Módulo</h1>
        <div class="row mb-5">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('modulos.update', ['modulo' => $modulo]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $modulo->nombre) }}" />
                                @if($errors->has('nombre'))
                                    <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="activo" class="form-label">Activo</label>
                                <input type="checkbox" class="form-check-input" id="activo" name="activo" @if($modulo->activo) checked @endif/>
                            </div>

                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col">
                <h1 class="float-start">Permisos del Módulo</h1>
                <a class="btn btn-success float-end" href="{{ route('permisos.new', ['modulo' => $modulo->id]) }}">Agregar Permiso</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-hover align-middle">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col">Nombre Corto</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Activo</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permisos as $permiso)
                                <tr>
                                    <td>{{ $permiso->nombre }}</td>
                                    <td>{{ $permiso->nombre_corto }}</td>
                                    <td>{{ $permiso->slug }}</td>
                                    <td>{{ $permiso->activo }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="{{ route('permisos.edit', ['permiso' => $permiso]) }}">Editar</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
