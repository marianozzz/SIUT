@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        <i class="bi bi-file-earmark-text text-info me-2"></i> Detalle de Actividad
    </h2>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">{{ $actividad->titulo }}</h5>
        </div>
        <div class="card-body">

            {{-- Descripción opcional --}}
            @if($actividad->descripcion)
                <p class="text-muted fst-italic">{{ $actividad->descripcion }}</p>
                <hr>
            @endif

            {{-- Contenido --}}
            <div>{!! $actividad->contenido !!}</div>

            {{-- Cursos asignados --}}
            @if($actividad->cursos->isNotEmpty())
                <hr>
                <h6>Cursos asignados:</h6>
                <ul>
                    @foreach($actividad->cursos as $curso)
                        <li>{{ $curso->nivel }} - {{ $curso->division->nombre ?? '' }}</li>
                    @endforeach
                </ul>
            @else
                <p><em>Esta actividad no está asignada a ningún curso.</em></p>
            @endif
        </div>

        <div class="card-footer text-end">
            <a href="{{ route('docentes.actividades.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver a la lista
            </a>
            <a href="{{ route('docentes.actividades.edit', $actividad) }}" class="btn btn-outline-primary">
                <i class="bi bi-pencil"></i> Editar
            </a>
        </div>
    </div>
</div>
@endsection
