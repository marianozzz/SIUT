@extends('adminlte::page')

@section('title', 'Cursos')

@section('content_header')
    <h1>Listado de Cursos</h1>
    <a href="{{ route('admin.cursos.create') }}" class="btn btn-primary float-right mb-2">Agregar Curso</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    @if($cursos->count())
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nivel</th>
                    <th>División</th>
                    <th>Turno</th>
                    <th>Especialidad</th>
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
                        <td>{{ $curso->especialidad->nombre ?? 'Sin especialidad' }}</td>
                        <td>
                            <a href="{{ route('admin.cursos.show', $curso->id) }}" class="btn btn-sm btn-info" title="Ver materias">
                                <i class="fas fa-book"></i>
                            </a>
                            <a href="{{ route('admin.cursos.asignar-alumnos', $curso->id) }}" class="btn btn-sm btn-success" title="Asignar alumnos">
                                <i class="fas fa-user-plus"></i>
                            </a>
                            <a href="{{ route('admin.cursos.edit', $curso->id) }}" class="btn btn-sm btn-warning" title="Editar curso">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.cursos.destroy', $curso->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Eliminar este curso?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Eliminar curso">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center">
            {{ $cursos->links() }}
        </div>

    @else
        <div class="alert alert-warning">
            No hay cursos registrados.
        </div>
    @endif
@stop
