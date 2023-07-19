@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Permisos</h1>

        <table class="table table-striped table-hover">
            <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Slug</th>
                <th scope="col">Activo</th>
                <th scope="col">Acciones</th>
            </tr>

            @foreach($permisos as $permiso)
            <tr>
                <td>{{ $permiso->nombre }}</td>
                <td>{{ $permiso->slug }}</td>
                <td>{{ $permiso->activo }}</td>
                <td></td>
            </tr>
            @endforeach

        </table>
    </div>
@endsection
