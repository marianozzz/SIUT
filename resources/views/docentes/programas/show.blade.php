@extends('layouts.docentes')

@section('content')
<div class="container mt-5">

    {{-- Card de Programa --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-journal-text"></i>
                Programa: {{ $programa->unidad }} - {{ $programa->eje_tematico }}
            </h5>
        </div>

        <div class="card-body">
            <p><strong>Cuatrimestre:</strong> {{ $programa->cuatrimestre }}°</p>

            <h6>Contenidos</h6>
            <div class="border rounded p-3 bg-light mb-4" style="white-space: normal;">
                {!! $programa->contenidos ?? '<em>No hay contenidos cargados.</em>' !!}
            </div>

            <h6>Actividades</h6>
            <div class="border rounded p-3 bg-light" style="white-space: pre-wrap;">
                {!! $programa->actividades ? nl2br(e($programa->actividades)) : '<em>No hay actividades cargadas.</em>' !!}
            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('docentes.planificaciones.show', $programa->planificacion) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver a Planificación
            </a>

            @can('update', $programa)
                <a href="{{ route('docentes.programas.edit', $programa) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Editar Programa
                </a>
            @endcan
        </div>
    </div>
</div>
@endsection
