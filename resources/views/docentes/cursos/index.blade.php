@extends('layouts.docentes')

@section('content')
<div class="py-5" style="background-color: #f1f3f5;">
    <div class="container">
        <h2 class="text-center mb-5 text-dark fw-bold">
            <i class="bi bi-journal-text me-2 fs-2 text-primary"></i>Mis Asignaturas Asignadas
        </h2>

        @if($asignaturasCursos->isEmpty())
            <div class="alert alert-warning text-center fs-5 rounded-3 shadow-sm">
                <i class="bi bi-exclamation-circle me-2"></i>No tenés asignaturas asignadas actualmente.
            </div>
        @else
            <div class="row g-4">
                @foreach($asignaturasCursos as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm border-0 rounded-3">
                            <div class="row g-0">
                                <div class="col-4 d-flex align-items-center justify-content-center bg-primary text-white rounded-start-3">
                                    <i class="bi bi-book display-5"></i>
                                </div>
                                <div class="col-8">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold text-dark mb-2">{{ $item->asignatura->nombre ?? 'Sin asignatura' }}</h5>
                                        
                                        <p class="card-text mb-1">
                                            <span class="badge bg-info text-dark">
                                                <i class="bi bi-easel2-fill me-1"></i>
                                                Curso: {{ $item->curso->nivel ?? 'Sin curso' }}
                                            </span>
                                        </p>

                                        <p class="card-text mb-1">
                                            <span class="badge bg-secondary">
                                                <i class="bi bi-people-fill me-1"></i>
                                                División: {{ $item->curso->division->nombre ?? 'Sin división' }}
                                            </span>
                                        </p>

                                        @if($item->grupoTaller)
                                            <p class="card-text mb-1">
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-diagram-3-fill me-1"></i>
                                                    Grupo: {{ $item->grupoTaller->nombre }}
                                                </span>
                                            </p>
                                        @endif

                                        <div class="text-end mt-2">
                                            <a href="{{ route('docentes.cursos.show', $item->curso->id) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                                <i class="bi bi-eye-fill me-1"></i> Ver
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

