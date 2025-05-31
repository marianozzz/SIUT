@extends('adminlte::page')

@section('title', 'Detalles del Curso')

@section('content_header')
    <h1>Curso: {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }} (Turno: {{ $curso->turno }})</h1>
    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop

@section('content')
    <h3>Asignaturas Asignadas</h3>

    @if($curso->asignaturas->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Asignatura</th>
                    <th>Profesor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($curso->asignaturas as $asignatura)
                    <tr>
                        <td>
                            <strong>{{ $asignatura->nombre }}</strong><br>
                            <a href="{{ route('admin.asignaturas.show', $asignatura->id) }}" class="btn btn-sm btn-info mt-1">
                                Ver programa
                            </a>
                        </td>
                        <td>
                            @if($asignatura->pivot->profesor_id)
                                @php
                                    $profesor = \App\Models\Docente::find($asignatura->pivot->profesor_id);
                                @endphp
                                {{ $profesor->apellido }}, {{ $profesor->nombre }}
                            @else
                                <span class="text-muted">Sin profesor asignado</span>
                                <br>
                                <a href="{{ route('admin.asignaturas.asignar-docente', [$curso->id, $asignatura->id]) }}" class="btn btn-sm btn-warning mt-1">
                                    Asignar docente
                                </a>
                            @endif
                        </td>
                        <td>
                            Tema: {{ $asignatura->pivot->tema ?? 'No definido' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Este curso no tiene asignaturas asignadas.</p>
    @endif
@stop
