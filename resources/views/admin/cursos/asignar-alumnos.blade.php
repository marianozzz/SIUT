@extends('adminlte::page')

@section('title', 'Asignar Alumnos')

@section('content_header')
    <h1>Asignar Alumnos al Curso: {{ $curso->nivel }}° {{ $curso->division->nombre ?? '' }}</h1>
@stop

@section('content')
    <form method="POST" action="{{ route('admin.cursos.guardar-alumnos', $curso->id) }}">
        @csrf

        <div class="form-group">
            <label for="alumnos">Seleccionar Alumnos</label>
            <select name="alumnos[]" id="alumnos" class="form-control" multiple size="10">
                @foreach($alumnos as $alumno)
                    <option value="{{ $alumno->id }}"
                        {{ $curso->alumnos->contains($alumno->id) ? 'selected' : '' }}>
                        {{ $alumno->apellido }}, {{ $alumno->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
        <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@stop
