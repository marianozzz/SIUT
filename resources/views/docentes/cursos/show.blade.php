@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-journal-text me-2"></i>
                Detalles del Curso: {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
            </h4>
        </div>

        <div class="card-body">

            {{-- Información del Curso --}}
            <div class="mb-4">
                <h5><i class="bi bi-info-circle me-2"></i> Información del Curso</h5>
                <p><strong>Año:</strong> {{ $curso->nivel }}</p>
                <p><strong>División:</strong> {{ $curso->division->nombre ?? 'Sin división' }}</p>
            </div>

            {{-- Asignaturas que dicta el docente --}}
            <div class="mb-4">
                <h5><i class="bi bi-book-half me-2"></i> Asignaturas que dictás</h5>

                @php
                    $asignadas = $curso->asignaturaCursos;
                @endphp

                @if($asignadas->isEmpty())
                    <p class="text-muted">No hay asignaturas asignadas en este curso.</p>
                @else
                    <ul class="list-group">
                        @foreach($asignadas as $asignaturaCurso)
                            <li class="list-group-item">
                                <h6 class="mb-1">
                                    <i class="bi bi-dot"></i> {{ $asignaturaCurso->asignatura->nombre ?? 'Sin asignatura' }}
                                </h6>
                                <small class="text-muted d-block">
                                    <strong>Tema:</strong> {{ $asignaturaCurso->tema ?? 'Sin tema' }}
                                </small>
                                <small class="text-muted d-block">
                                    <strong>Grupo:</strong> {{ $asignaturaCurso->grupoTaller->nombre ?? 'Sin grupo' }}
                                </small>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            {{-- Tabla de Alumnos con resumen de asistencia y calificaciones --}}
            <div class="mb-4">
                <h5><i class="bi bi-people-fill me-2"></i> Alumnos del Curso</h5>

                @if($curso->alumnos->isEmpty())
                    <p class="text-muted">No hay alumnos asignados a este curso.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Apellido y Nombre</th>
                                    <th>Asistencia</th>
                                    <th>Promedio de Calificaciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // Fechas únicas de asistencia registradas en este curso
                                    $fechasCurso = $curso->alumnos
                                        ->flatMap(fn($a) => $a->asistencias->where('curso_id', $curso->id)->pluck('fecha'))
                                        ->unique();

                                    $totalFechas = $fechasCurso->count();
                                @endphp

                                @foreach($curso->alumnos as $alumno)
                                    <tr>
                                        <td>{{ $alumno->apellido }}, {{ $alumno->nombre }}</td>
                                        <td>
                                            @php
                                                $presentes = $alumno->asistencias
                                                    ->where('curso_id', $curso->id)
                                                    ->where('presente', true)
                                                    ->pluck('fecha')
                                                    ->unique()
                                                    ->count();

                                                $porcentaje = $totalFechas > 0 ? round(($presentes / $totalFechas) * 100) : 0;
                                            @endphp
                                            {{ $porcentaje }}% presente
                                        </td>
                                        <td>
                                            @php
                                                $notas = $alumno->calificaciones->where('curso_id', $curso->id);
                                                $promedio = $notas->count() > 0 ? round($notas->avg('nota'), 2) : '-';
                                            @endphp
                                            {{ $promedio }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Opciones generales --}}
                    <div class="mt-3 d-flex flex-wrap gap-2">
                        <a href="{{ route('docentes.asistencias.create', $curso->id) }}"
                           class="btn btn-primary">
                            <i class="bi bi-check2-square"></i> Tomar Asistencia de la Clase
                        </a>

                        <a href="{{ route('docentes.calificaciones.create', $curso->id) }}"
                           class="btn btn-success">
                            <i class="bi bi-pencil-square"></i> Cargar Calificaciones de la Clase
                        </a>

                        <a href="{{ route('docentes.asistencias.index', $curso->id) }}"
                           class="btn btn-outline-dark">
                            <i class="bi bi-list-check"></i> Detalle de Asistencias
                        </a>
                    </div>
                @endif
            </div>

        </div>

        <div class="card-footer text-end bg-white border-0">
            <a href="{{ route('docentes.cursos.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection



