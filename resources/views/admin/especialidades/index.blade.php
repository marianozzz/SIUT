@extends('adminlte::page')

@section('title', 'Especialidades')

@section('content_header')
    <h1>Especialidades</h1>
@stop

@section('content')
    <a href="{{ route('admin.especialidades.create') }}" class="btn btn-primary mb-3">Nueva Especialidad</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($especialidades as $especialidad)
                <tr>
                    <td>{{ $especialidad->nombre }}</td>
                    <td>{{ $especialidad->descripcion }}</td>
                    <td>
                        <a href="{{ route('admin.especialidades.show', $especialidad) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('admin.especialidades.edit', $especialidad) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.especialidades.destroy', $especialidad) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
