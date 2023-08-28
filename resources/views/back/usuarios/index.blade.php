@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <h1 class="float-start">Usuarios</h1>
                @if (Auth::user()->super_admin || Auth::user()->hasPermiso('crear-usuarios'))
                    <a class="btn btn-success float-end" href="{{ route('usuarios.new') }}">Nuevo Usuario</a>
                @endif
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre de Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Email</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->username }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->apellido }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    @if($usuario->activo)
                                        <span class="badge bg-success">Activo</span>
                                    @else
                                        <span class="badge bg-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    @if (Auth::user()->super_admin || Auth::user()->hasPermiso('editar-usuarios'))
                                        <a class="btn btn-sm btn-primary" href="{{ route('usuarios.edit', ['usuario' => $usuario]) }}">Editar</a>
                                    @endif

                                    @if (Auth::user()->super_admin || Auth::user()->hasPermiso('asignar-permisos'))
                                        <a class="btn btn-sm btn-success" href="{{ route('usuarios.permisos.edit', ['usuario' => $usuario]) }}">Permisos</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col d-flex justify-content-center align-items-center">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
@endsection
