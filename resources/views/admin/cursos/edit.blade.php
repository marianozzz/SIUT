@extends('adminlte::page')

@section('title', 'Editar Curso')

@section('content_header')
    <h1>Editar Curso: {{ $curso->nombre }}</h1>
@stop

@section('content')
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if($errors->any())
        <x-adminlte-alert theme="danger" title="Errores encontrados">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <form method="POST" action="{{ route('admin.cursos.update', $curso) }}">
        @csrf
        @method('PUT')

        <x-adminlte-input name="nivel" label="Nivel" value="{{ old('nivel', $curso->nivel) }}" required />

        <x-adminlte-select name="division_id" label="División" required>
            @foreach($divisiones as $division)
                <option value="{{ $division->id }}" {{ $division->id == old('division_id', $curso->division_id) ? 'selected' : '' }}>
                    {{ $division->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-select name="especialidad_id" label="Especialidad" required>
            <option value="">-- Seleccionar --</option>
            @foreach($especialidades as $especialidad)
                <option value="{{ $especialidad->id }}" {{ $especialidad->id == old('especialidad_id', $curso->especialidad_id) ? 'selected' : '' }}>
                    {{ $especialidad->nombre }}
                </option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-button type="submit" label="Actualizar Curso" theme="primary" class="mt-2" />
    </form>

    <hr>

    <h3>Asignar Asignatura</h3>
    <form method="POST" action="{{ route('admin.cursos.asignarAsignatura', $curso->id) }}">
        @csrf

        <x-adminlte-select name="asignatura_id" label="Asignatura" required>
            @foreach($asignaturas as $asignatura)
                <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-textarea name="tema" label="Tema para este curso" rows=3 required></x-adminlte-textarea>

        <x-adminlte-button type="submit" label="Asignar Asignatura" theme="success" class="mt-2" />
    </form>

    <hr>

    <h3>Asignaturas Asignadas</h3>
    @if($curso->asignaturas->count())
        <ul class="list-group">
            @foreach($curso->asignaturas as $asignatura)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $asignatura->nombre }}</strong><br>
                        <small>Tema: {{ $asignatura->pivot->tema }}</small>
                    </div>
                    <form method="POST" action="{{ route('admin.cursos.quitarAsignatura', [$curso->id, $asignatura->id]) }}">
                        @csrf
                        @method('DELETE')
                        <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash" title="Quitar" />
                    </form>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay asignaturas asignadas a este curso.</p>
    @endif
@stop
