@extends('adminlte::page')

@section('title', 'Editar Asignación')

@section('content_header')
    <h1>Editar Asignación de Asignatura a Curso</h1>
@stop

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.asignatura-cursos.update', $asignaturaCurso->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Curso --}}
        <x-adminlte-select name="curso_id" label="Curso" required>
            @foreach ($cursos as $curso)
                <option value="{{ $curso->id }}" {{ $curso->id == $asignaturaCurso->curso_id ? 'selected' : '' }}>
                    {{ $curso->nivel }} - {{ $curso->division->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        {{-- Asignatura --}}
        <x-adminlte-select name="asignatura_id" label="Asignatura" required>
            @foreach ($asignaturas as $asignatura)
                <option value="{{ $asignatura->id }}" {{ $asignatura->id == $asignaturaCurso->asignatura_id ? 'selected' : '' }}>
                    {{ $asignatura->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        {{-- Docente --}}
        <x-adminlte-select name="profesor_id" label="Docente">
            <option value="">-- Sin asignar --</option>
            @foreach ($docentes as $docente)
                <option value="{{ $docente->id }}" {{ $docente->id == $asignaturaCurso->profesor_id ? 'selected' : '' }}>
                    {{ $docente->nombre_completo }}
                </option>
            @endforeach
        </x-adminlte-select>

        {{-- Turno --}}
        <x-adminlte-select name="turno_id" label="Turno">
            <option value="">-- Sin asignar --</option>
            @foreach ($turnos as $turno)
                <option value="{{ $turno->id }}" {{ $turno->id == $asignaturaCurso->turno_id ? 'selected' : '' }}>
                    {{ $turno->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        {{-- Tema --}}
        <x-adminlte-textarea name="tema" label="Tema (opcional)" rows="3">
            {{ old('tema', $asignaturaCurso->tema) }}
        </x-adminlte-textarea>

        {{-- Horarios --}}
        <h5 class="mt-4">Días y Horarios</h5>
        @php
            $dias = ['lunes','martes','miercoles','jueves','viernes'];
            $horarios = $asignaturaCurso->horarios->keyBy('dia');
        @endphp

        @foreach ($dias as $dia)
            @php
                $horario = $horarios[$dia] ?? null;
            @endphp
            <div class="row mb-2 align-items-center">
                <div class="col-md-2">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="dia_{{ $dia }}" name="dias[{{ $dia }}][activo]" {{ $horario ? 'checked' : '' }}>
                        <label class="form-check-label" for="dia_{{ $dia }}">{{ ucfirst($dia) }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="dias[{{ $dia }}][hora_entrada]" value="{{ $horario ? $horario->hora_entrada : '' }}">
                </div>
                <div class="col-md-2">
                    <input type="time" class="form-control" name="dias[{{ $dia }}][hora_salida]" value="{{ $horario ? $horario->hora_salida : '' }}">
                </div>
            </div>
        @endforeach

        {{-- Botones --}}
        <div class="d-flex justify-content-start mt-4">
            <x-adminlte-button type="submit" label="Actualizar" theme="primary" class="mr-2" />
            <a href="{{ route('admin.asignatura-cursos.index') }}" class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
@stop
