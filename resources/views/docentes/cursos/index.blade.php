@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">
        <i class="bi bi-journal-text me-2"></i>Mis Asignaturas Asignadas
    </h2>

    @if($asignaturasCursos->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i> No tenés asignaturas asignadas actualmente.
        </div>
    @else
        <div class="row g-4">
            @foreach($asignaturasCursos as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-book me-1"></i> {{ $item->asignatura->nombre ?? 'Sin asignatura' }}
                            </h5>
                            <p class="mb-2">
                                <span class="badge bg-info text-dark">
                                    Curso: {{ $item->curso->nivel ?? 'Sin curso' }}
                                </span>
                                <span class="badge bg-secondary">
                                    División: {{ $item->curso->division->nombre ?? 'Sin división' }}
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-white border-0 text-end">
                            <a href="{{ route('docentes.cursos.show', $item->curso->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye"></i> Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

