@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"><i class="bi bi-journal-text me-2"></i>Mis Cursos Asignados</h2>

    @if($cursos->isEmpty())
        <div class="alert alert-warning text-center">
            <i class="bi bi-exclamation-circle"></i> No tenés cursos asignados actualmente.
        </div>
    @else
        <div class="row g-4">
            @foreach($cursos as $curso)
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow rounded-3">
                        <div class="card-body">
                            <h5 class="card-title text-primary">
                                <i class="bi bi-mortarboard-fill me-1"></i> {{ $curso->nombre }}
                            </h5>
                            <p class="mb-2">
                                <span class="badge bg-info text-dark">Año: {{ $curso->nivel }}</span>
                                <span class="badge bg-secondary">División: {{ $curso->division->nombre ?? 'Sin división' }}</span>
                            </p>
                            <hr>
                            <p class="mb-1"><strong>Asignaturas:</strong></p>
                            <ul class="list-unstyled ps-3 mb-0">
                                @forelse($curso->asignaturas as $asignatura)
                                    <li><i class="bi bi-dot"></i> {{ $asignatura->nombre }}</li>
                                @empty
                                    <li><em>No hay asignaturas asignadas</em></li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="card-footer bg-white border-0 text-end">
                            <button class="btn btn-sm btn-outline-primary" disabled>
                                Ver Detalles
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
