@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>Listado de Cursos</h1>
    <a href="{{ route('admin.cursos.create') }}" class="btn btn-primary">Agregar Curso</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($cursos->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nivel</th>
                    <th>División</th>
                    <th>Turno</th>
                    <th>Especialidad</th> {{-- Nueva columna --}}
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cursos as $curso)
                    <tr>
                        <td>{{ $curso->id }}</td>
                        <td>{{ $curso->nivel }}</td>
                        <td>{{ $curso->division->nombre ?? 'Sin división' }}</td>
                        <td>{{ $curso->turno }}</td>
                        <td>{{ $curso->especialidad->nombre ?? 'Sin especialidad' }}</td> {{-- Nueva columna --}}
                        <td>
                            <a href="{{ route('admin.cursos.show', $curso->id) }}" class="btn btn-sm btn-info">Ver Materias</a>
                            <a href="{{ route('admin.cursos.asignar-alumnos', $curso->id) }}" class="btn btn-sm btn-success">Asignar Alumnos</a>
                            <a href="{{ route('admin.cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este curso?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <strong>No hay cursos registrados.</strong>
    @endif
@stop
