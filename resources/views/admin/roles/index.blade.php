@extends('adminlte::page')

@section('title', 'Roles')

@section('content_header')
    <h1>Lista de Roles</h1>
@stop

@section('content')
    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary mb-3">➕ Nuevo Rol</a>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Permisos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->id }}</td>
                            <td>{{ $rol->name }}</td>
                            <td>{{ implode(', ', $rol->permissions->pluck('name')->toArray()) }}</td>
                            <td>
                                <a href="{{ route('admin.roles.edit', $rol->id) }}" class="btn btn-sm btn-warning">✏️ Editar</a>
                                <form action="{{ route('admin.roles.destroy', $rol->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar este rol?')">
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
