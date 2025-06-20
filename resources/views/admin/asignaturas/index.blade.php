@extends('adminlte::page')

@section('title', 'Listado de Asignaturas')

@section('content_header')
    <h1>Listado de Asignaturas</h1>
    <a href="{{ route('admin.asignaturas.create') }}" class="btn btn-primary">Crear nueva asignatura</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($asignaturas->count())
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignaturas as $asignatura)
                    <tr>
                        <td>{{ $asignatura->nombre }}</td>
                        <td>{{ $asignatura->descripcion ?? '-' }}</td>
                        <td>{{ $asignatura->categoria ? $asignatura->categoria->nombre : 'Sin categoría' }}</td>
                        <td>
                            <a href="{{ route('admin.asignaturas.show', $asignatura->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('admin.asignaturas.edit', $asignatura->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.asignaturas.destroy', $asignatura->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar asignatura?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay asignaturas cargadas.</p>
    @endif
@stop
