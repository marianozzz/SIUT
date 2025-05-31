@extends('adminlte::page')

@section('title', 'Asignar Docente')

@section('content_header')
    <h1>Asignar Docente a "{{ $asignatura->nombre }}"</h1>
@stop

@section('content')
    <form action="{{ route('admin.asignaturas.guardar-docente', [$curso->id, $asignatura->id]) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="profesor_id">Seleccionar Docente</label>
            <select name="profesor_id" id="profesor_id" class="form-control" required>
                <option value="">-- Seleccione --</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}">{{ $docente->apellido }}, {{ $docente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar</button>
        <a href="{{ route('admin.cursos.show', $curso->id) }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
