@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-list-ul"></i> Programas de {{ $planificacion->asignatura->nombre }} - {{ $planificacion->curso->nivel }} {{ $planificacion->curso->division->nombre }}
            </h5>
            <a href="{{ route('docentes.planificaciones.programas.create', $planificacion->id) }}" class="btn btn-sm btn-light">
                <i class="bi bi-plus-circle"></i> Nuevo Programa
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($programas->isEmpty())
                <p class="text-muted">No hay programas registrados para esta planificación.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Eje Temático</th>
                                <th>Unidad</th>
                                <th>Cuatrimestre</th>
                                <th>Contenidos</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($programas as $programa)
                            <tr>
                                <td>{{ $programa->eje_tematico }}</td>
                                <td>{{ $programa->unidad }}</td>
                                <td>{{ $programa->cuatrimestre }}</td>
                                <td>{{ Str::limit(strip_tags($programa->contenidos), 100) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('docentes.planificaciones.programas.edit', [$planificacion->id, $programa->id]) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('docentes.planificaciones.programas.destroy', [$planificacion->id, $programa->id]) }}"
                                          method="POST" class="d-inline-block"
                                          onsubmit="return confirm('¿Eliminar este programa?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <a href="{{ route('docentes.planificaciones.show', $planificacion->id) }}" class="btn btn-outline-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Volver a la planificación
            </a>
        </div>
    </div>
</div>
@endsection

