@extends('adminlte::page')

@section('title', 'Asignar Alumnos al Grupo')

@section('content_header')
    <h1>Asignar Alumnos al Grupo: {{ $grupo->nombre }}</h1>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.grupos.updateAlumnos', $grupo) }}">
        @csrf
        @method('PUT')

        @if ($alumnos->isEmpty())
            <p>No hay alumnos en el curso asociado.</p>
        @else
            <div class="form-group">
                <label>Seleccione los alumnos para este grupo:</label>
                <div class="border rounded p-2" style="max-height: 400px; overflow-y: auto;">
                    @foreach ($alumnos as $alumno)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="alumnos[]" value="{{ $alumno->id }}"
                                id="alumno_{{ $alumno->id }}"
                                {{ in_array($alumno->id, $alumnosGrupo) ? 'checked' : '' }}>
                            <label class="form-check-label" for="alumno_{{ $alumno->id }}">
                                {{ $alumno->apellido }}, {{ $alumno->nombre }} ({{ $alumno->dni }})
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar Asignaciones</button>
            <a href="{{ route('admin.grupos.index') }}" class="btn btn-secondary">Volver</a>
        @endif
    </form>
@stop
