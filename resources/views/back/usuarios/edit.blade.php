@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-3">Editar Usuario</h1>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('usuarios.update', ['usuario' => $usuario]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" />
                                @if($errors->has('nombre'))
                                    <div class="invalid-feedback">{{ $errors->first('nombre') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}" />
                                @if($errors->has('apellido'))
                                    <div class="invalid-feedback">{{ $errors->first('apellido') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="username" class="form-label">Nombre de usuario</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $usuario->username) }}" />
                                @if($errors->has('username'))
                                    <div class="invalid-feedback">{{ $errors->first('username') }}</div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $usuario->email) }}" />
                                @if($errors->has('email'))
                                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                @endif
                            </div>

                            @if(Auth::user()->super_admin)
                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="activo" name="activo" @if($usuario->activo) checked @endif/>
                                    <label for="activo" class="form-label">Activo</label>
                                </div>

                                <div class="mb-3">
                                    <input type="checkbox" class="form-check-input" id="super_admin" name="super_admin" @if($usuario->super_admin) checked @endif/>
                                    <label for="super_admin" class="form-label">Super Admin</label>
                                </div>
                            @endif

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
