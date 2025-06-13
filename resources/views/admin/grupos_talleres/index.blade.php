@extends('adminlte::page')

@section('title', 'Grupos de Taller')

@section('content_header')
    <h1>Grupos de Taller</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('admin.grupos.create') }}" class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Nuevo Grupo
        </a>
    </div>

    @if ($grupos->isEmpty())
        <div class="alert alert-info text-center">
            No hay grupos de taller creados aún.
        </div>
    @else
        <div class="card">
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>Grupo</th>
                            <th>Asignatura</th>
                            <th>Día y Horario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grupos as $grupo)
                            <tr>
                                <td>
                                    {{ $grupo->asignaturaCurso->curso->nivel ?? '' }}
                                    {{ $grupo->asignaturaCurso->curso->division->nombre ?? '' }}
                                </td>
                                <td>{{ $grupo->nombre }}</td>
                                <td>{{ $grupo->asignaturaCurso->asignatura->nombre ?? '-' }}</td>
                                <td>{{ $grupo->dia ?? '-' }} {{ $grupo->horario ?? '' }}</td>
                                <td>
                                    <a href="{{ route('admin.grupos.edit', $grupo) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.grupos.editAlumnos', $grupo) }}" class="btn btn-sm btn-info" title="Asignar Alumnos">
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                    <form action="{{ route('admin.grupos.destroy', $grupo) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este grupo?')" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@stop
