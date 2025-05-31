@extends('adminlte::page')

@section('title', 'Alumnos')

@section('content_header')
    <h1>Listado de Alumnos</h1>
    <a href="{{ route('admin.alumnos.create') }}" class="btn btn-primary">Nuevo Alumno</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Apellido y Nombre</th>
                <th>DNI</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alumnos as $alumno)
                <tr>
                    <td>{{ $alumno->apellido }}, {{ $alumno->nombre }}</td>
                    <td>{{ $alumno->dni }}</td>
                    <td>
                        <a href="{{ route('admin.alumnos.show', $alumno) }}" class="btn btn-sm btn-info">Ver</a>
                        <a href="{{ route('admin.alumnos.edit', $alumno) }}" class="btn btn-sm btn-warning">Editar</a>
                        <form action="{{ route('admin.alumnos.destroy', $alumno) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar alumno?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
