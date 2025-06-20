@extends('adminlte::page')

@section('title', 'Asignar Asignatura a Curso')

@section('content_header')
    <h1>Asignar Asignatura a Curso</h1>
@stop

@section('content')
    <form method="POST" action="{{ route('admin.asignatura-cursos.store') }}">
        @csrf

        {{-- SELECCIÓN DE CURSO --}}
        <x-adminlte-select name="curso_id" label="Curso" required>
            @foreach($cursos as $curso)
                <option value="{{ $curso->id }}">
                    {{ $curso->nivel }} - {{ $curso->division->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        {{-- ASIGNATURA --}}
        <x-adminlte-select name="asignatura_id" label="Asignatura" required>
            @foreach($asignaturas as $asignatura)
                <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
            @endforeach
        </x-adminlte-select>

        {{-- DOCENTE --}}
        <x-adminlte-select name="profesor_id" label="Docente">
            <option value="">-- Ninguno --</option>
            @foreach($docentes as $docente)
                <option value="{{ $docente->id }}">{{ $docente->nombre_completo }}</option>
            @endforeach
        </x-adminlte-select>

        {{-- TURNO --}}
        <x-adminlte-select name="turno_id" label="Turno">
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ $turno->nombre }}</option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-textarea name="tema" label="Tema" rows=3></x-adminlte-textarea>

        {{-- HORARIOS --}}
        <h5>Días y Horarios</h5>
        @php $dias = ['lunes','martes','miercoles','jueves','viernes']; @endphp
        @foreach($dias as $dia)
            <div class="row mb-2">
                <div class="col-md-2">
                    <input type="checkbox" name="dias[{{ $dia }}][activo]" id="dia_{{ $dia }}">
                    <label for="dia_{{ $dia }}">{{ ucfirst($dia) }}</label>
                </div>
                <div class="col-md-2">
                    <input type="time" name="dias[{{ $dia }}][hora_entrada]" class="form-control">
                </div>
                <div class="col-md-2">
                    <input type="time" name="dias[{{ $dia }}][hora_salida]" class="form-control">
                </div>
            </div>
        @endforeach

        <x-adminlte-button label="Guardar Asignación" type="submit" theme="success" class="mt-2" />
    </form>
@stop
