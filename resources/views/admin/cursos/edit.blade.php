@extends('adminlte::page')

@section('title', 'Editar Curso')

@section('content_header')
    <h1>Editar Curso: {{ $curso->nivel }} - {{ $curso->division->nombre }}</h1>
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

    {{-- Formulario edición del curso --}}
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

    {{-- Asignar nueva asignatura --}}
    <h3>Asignar Asignatura</h3>

    <form method="POST" action="{{route('admin.horarios.store')}}">
        @csrf

        <input type="hidden" name="curso_id" value="{{ $curso->id }}">

        <x-adminlte-select name="asignatura_id" label="Asignatura" required>
            @foreach($asignaturas as $asignatura)
                <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-select name="turno_id" label="Turno" required>
            <option value="">-- Seleccionar Turno --</option>
            @foreach($turnos as $turno)
                <option value="{{ $turno->id }}">{{ ucfirst($turno->nombre) }}</option>
            @endforeach
        </x-adminlte-select>

        <x-adminlte-textarea name="tema" label="Tema para este curso" rows=3 required></x-adminlte-textarea>

        {{-- Días y horarios --}}
        <label class="mt-3">Días y horarios</label>
        @php
            $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
        @endphp

        @foreach($dias as $dia)
            <div class="row align-items-center mb-2">
                <div class="col-md-2">
                    <div class="form-check">
                        <input type="checkbox" name="dias[{{ $dia }}][activo]" id="check-{{ $dia }}" class="form-check-input" />
                        <label class="form-check-label" for="check-{{ $dia }}">{{ ucfirst($dia) }}</label>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="time" name="dias[{{ $dia }}][hora_entrada]" class="form-control" placeholder="Hora inicio">
                </div>
                <div class="col-md-2">
                    <input type="time" name="dias[{{ $dia }}][hora_salida]" class="form-control" placeholder="Hora fin">
                </div>
            </div>
        @endforeach

        <x-adminlte-button type="submit" label="Asignar Asignatura" theme="success" class="mt-2" />
    </form>

    <hr>

    {{-- Lista de asignaturas agrupadas --}}
    <h3>Asignaturas Asignadas</h3>
    @php
        $asignadas = $curso->asignaturaCursos()->with('asignatura', 'horarios', 'turno')->get();
        $agrupadas = $asignadas->groupBy('asignatura_id');
    @endphp

    @if($agrupadas->count())
        <ul class="list-group">
            @foreach($agrupadas as $asignaturaId => $items)
                @php
                    $asignaturaNombre = $items->first()->asignatura->nombre;
                @endphp
                <li class="list-group-item">
                    <h5 class="mb-2">{{ $asignaturaNombre }}</h5>

                    <ul class="mb-2">
                        @foreach($items as $asigCurso)
                            <li class="mb-2">
                                <div>
                                    <strong>Tema:</strong> {{ $asigCurso->tema ?? 'Sin tema' }}<br>
                                    <strong>Turno:</strong> {{ ucfirst($asigCurso->turno->nombre ?? 'No asignado') }}<br>

                                    <strong>Horarios:</strong>
                                    @if($asigCurso->horarios->isEmpty())
                                        <span class="text-muted">Sin horarios asignados</span>
                                    @else
                                        <ul>
                                            @foreach($asigCurso->horarios as $horario)
                                                <li>
                                                    {{ ucfirst($horario->dia) }}:
                                                    {{ \Carbon\Carbon::parse($horario->hora_entrada)->format('H:i') }} -
                                                    {{ \Carbon\Carbon::parse($horario->hora_salida)->format('H:i') }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>

                                {{-- Botón eliminar solo esta asignación --}}
                                <form method="POST" action="{{ route('admin.cursos.quitarAsignatura', [$curso->id, $asigCurso->asignatura->id]) }}" class="mt-1">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="asignatura_curso_id" value="{{ $asigCurso->id }}">
                                    <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash" title="Quitar esta asignación" />
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    @else
        <p>No hay asignaturas asignadas a este curso.</p>
    @endif
@stop
