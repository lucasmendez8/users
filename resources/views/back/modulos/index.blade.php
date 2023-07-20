@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col">
                <h1 class="float-start">Módulos</h1>
                <a class="btn btn-success float-end" href="{{ route('modulos.new') }}">Nuevo Módulo</a>
            </div>
        </div>

        <table class="table table-striped table-hover align-middle">
            <thead>
                <tr>
                    <th scope="col">Módulo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($modulos as $modulo)
                    <tr>
                        <td>{{ $modulo->nombre }}</td>
                        <td>{{ $modulo->activo }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{ route('modulos.update', ['modulo' => $modulo]) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $modulos->links() }}
    </div>
@endsection
