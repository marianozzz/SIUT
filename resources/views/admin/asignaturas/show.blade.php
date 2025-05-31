@extends('adminlte::page')

@section('title', 'Detalle de Asignatura')

@section('content_header')
    <h1>Asignatura: {{ $asignatura->nombre }}</h1>
    <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>Descripción:</strong></h5>
            <p>{{ $asignatura->descripcion ?? 'Sin descripción' }}</p>

            <hr>

            <h5><strong>Temas por Curso:</strong></h5>

            @if($asignatura->cursos->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Curso</th>
                            <th>División</th>
                            <th>Turno</th>
                            <th>Profesor</th>
                            <th>Tema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($asignatura->cursos as $curso)
                            <tr>
                                <td>{{ $curso->nivel }}°</td>
                                <td>{{ $curso->division->nombre ?? 'Sin división' }}</td>
                                <td>{{ ucfirst($curso->turno) }}</td>
                                <td>
                                 @php
                                    $docente = \App\Models\Docente::find($curso->pivot->profesor_id);
                                @endphp

                                {{ $docente ? $docente->nombre_completo : 'No asignado' }}

                                </td>
                                <td>{{ $curso->pivot->tema ?? 'No especificado' }}</td>
                                <td>
                                    <a href="{{ route('admin.asignaturas.show', [$asignatura->id, $curso->id]) }}" class="btn btn-sm btn-info">
                                        Ver programa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay cursos asignados a esta asignatura.</p>
            @endif
        </div>
    </div>
@stop
