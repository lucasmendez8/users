@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Permisos de Usuario</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('usuarios.permisos.update', ['usuario' => $usuario]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-5">
                                <label for="nombre" class="form-label">Nombre de Usuario: </label>
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $usuario->username }}" disabled/>
                            </div>

                            <div class="row">
                                @foreach($modulos as $modulo)
                                    <div class="col-lg-3">
                                        <div class="mb-3">
                                            <h3>{{ $modulo->nombre }}</h3>

                                            @foreach($modulo->permisos as $permiso)
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="checkbox" class="form-check-input" id="{{ $permiso->slug }}" name="{{ $permiso->slug }}" @if(in_array($permiso->id, $arrPermisos)) checked @endif/>
                                                        <label for="{{ $permiso->slug }}" class="form-label">{{ $permiso->nombre_corto }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{ Auth::user()->hasPermiso('editar-usuario') }}

                            <button type="submit" class="btn btn-primary" onclick="send(this)">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
