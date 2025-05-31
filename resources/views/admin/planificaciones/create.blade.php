@extends('adminlte::page')

@section('title', 'Crear Planificación')

@section('content_header')
    <h1>Nueva Planificación</h1>
@stop

@section('content')
    <form action="{{ route('admin.planificaciones.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="asignatura_id">Asignatura</label>
            <select name="asignatura_id" class="form-control" required>
                <option value="">Seleccione una asignatura</option>
                @foreach($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="curso_id">Curso (Nivel y División)</label>
            <select name="curso_id" class="form-control" required>
                <option value="">Seleccione un curso</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">
                        {{ $curso->nivel }}° {{ $curso->division->nombre ?? 'Sin división' }} (Turno {{ ucfirst($curso->turno) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="anio">Año</label>
            <input type="number" name="fecha" class="form-control" value="{{ date('Y') }}" required>
        </div>

        <div class="mb-3">
            <label for="contenido">Contenido</label>
            <textarea name="contenido" rows="5" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
        <a href="{{ route('admin.planificaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
