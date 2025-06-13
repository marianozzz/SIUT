@extends('adminlte::page')

@section('title', 'Listado de Alumnos')

@section('content_header')
    <h1>Listado de Alumnos</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.alumnos.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-user-plus"></i> Nuevo Alumno
    </a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Curso</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($alumnos as $alumno)
                @php
                    $curso = $alumno->cursos->last(); // último curso asignado (puede ser null)
                @endphp
                <tr>
                    <td>{{ $alumno->apellido }}, {{ $alumno->nombre }}</td>
                    <td>{{ $alumno->dni }}</td>
                    <td>
                        {{ $curso?->nivel ?? 'No asignado' }}
                        {{ $curso?->division->nombre ?? '' }}
                    </td>
                    <td>{{ $alumno->email ?? '-' }}</td>
                    <td>{{ $alumno->telefono ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.alumnos.edit', $alumno) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.alumnos.destroy', $alumno) }}" method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Estás seguro de eliminar este alumno?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
