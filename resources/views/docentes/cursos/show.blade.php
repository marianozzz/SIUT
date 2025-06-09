@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-journal-text me-2"></i> Detalles del Curso: {{ $curso->nombre }}
            </h4>
        </div>
        <div class="card-body">

            <div class="mb-4">
                <h5><i class="bi bi-info-circle me-2"></i> Información del Curso</h5>
                <p><strong>Año:</strong> {{ $curso->nivel }}</p>
                <p><strong>División:</strong> {{ $curso->division->nombre ?? 'Sin división' }}</p>
            </div>

            <div>
                <h5><i class="bi bi-book-half me-2"></i> Asignaturas que dictás</h5>

                @php
                    $asignadas = $curso->asignaturaCursos->where('profesor_id', auth()->user()->docente->id);
                @endphp

                @if($asignadas->isEmpty())
                    <p class="text-muted">No hay asignaturas asignadas en este curso.</p>
                @else
                    <ul class="list-group">
                        @foreach($asignadas as $asigCurso)
                            <li class="list-group-item">
                                <h6 class="mb-1">
                                    <i class="bi bi-dot"></i> {{ $asigCurso->asignatura->nombre }}
                                </h6>
                                <small class="text-muted d-block">
                                    <strong>Tema:</strong> {{ $asigCurso->tema ?? 'Sin tema' }}<br>
                                    <strong>Horarios:</strong>
                                    @if($asigCurso->horarios->isEmpty())
                                        <span class="text-muted">No asignados</span>
                                    @else
                                        <ul class="mb-0 ps-3">
                                            @foreach($asigCurso->horarios as $horario)
                                                <li>{{ ucfirst($horario->dia) }} - {{ \Carbon\Carbon::parse($horario->hora_entrada)->format('H:i') }} a {{ \Carbon\Carbon::parse($horario->hora_salida)->format('H:i') }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </small>
                            </li>
                        @endforeach
                    </ul>
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


