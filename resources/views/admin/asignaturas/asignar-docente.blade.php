@extends('adminlte::page')

@section('title', 'Asignar Docente por Día')

@section('content_header')
    <h1>Asignar Docente por Día a {{ $asignaturaCurso->asignatura->nombre }} - Curso: {{ $asignaturaCurso->curso->nombre }}</h1>
@stop

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.horarios.asignar-docente') }}" method="POST">
        @csrf

        <input type="hidden" name="asignatura_curso_id" value="{{ $asignaturaCurso->id }}">

        <div class="form-group">
            <label for="dia">Día</label>
            <select name="dia" id="dia" class="form-control" required>
                @foreach($asignaturaCurso->horarios as $horario)
                    <option value="{{ $horario->dia }}">{{ ucfirst($horario->dia) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="profesor_id">Docente</label>
            <select name="profesor_id" id="profesor_id" class="form-control" required>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}">{{ $docente->apellido }}, {{ $docente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Asignar</button>
    </form>
@stop
