@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        <i class="bi bi-folder2-open text-info me-2"></i> Mis Actividades
    </h2>

    <div class="mb-3 text-end">
        <a href="{{ route('docentes.actividades.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Actividad
        </a>
    </div>

    @if($actividades->isEmpty())
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> No hay actividades creadas aún.
        </div>
    @else
        <div class="row g-4">
            @foreach($actividades as $actividad)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-info">
                                <i class="bi bi-file-earmark-text"></i> {{ $actividad->titulo }}
                            </h5>

                            @if($actividad->descripcion)
                                <p class="text-muted mb-0">
                                    {{ Str::limit($actividad->descripcion, 120) }}
                                </p>
                            @else
                                <p class="text-muted fst-italic">Sin descripción</p>
                            @endif
                        </div>
                        <div class="card-footer bg-white text-end">
                            <a href="{{ route('docentes.actividades.show', $actividad) }}" class="btn btn-sm btn-outline-info">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                            <a href="{{ route('docentes.actividades.edit', $actividad) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-pencil"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection


