@extends('adminlte::page')

@section('title', 'Permisos')

@section('content_header')
    <h1>Lista de Permisos</h1>
@stop

@section('content')
    <a href="{{ route('admin.permisos.create') }}" class="btn btn-primary mb-3">➕ Nuevo Permiso</a>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permisos as $permiso)
                        <tr>
                            <td>{{ $permiso->id }}</td>
                            <td>{{ $permiso->name }}</td>
                            <td>
                                <a href="{{ route('admin.permisos.edit', $permiso) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                <form action="{{ route('admin.permisos.destroy', $permiso) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este permiso?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
