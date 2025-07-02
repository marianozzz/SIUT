@extends('layouts.docentes')

@section('content')
<div class="container mt-5">

    {{-- Card de Planificación General --}}
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">
                <i class="bi bi-journal-text"></i>
                Planificación de {{ $planificacion->asignatura->nombre }} - 
                {{ $planificacion->curso->nivel }} {{ $planificacion->curso->division->nombre }}
            </h5>
        </div>
        <div class="card-body">
            <p><strong>Año:</strong> {{ $planificacion->fecha }}</p>
            <p><strong>Contenido general:</strong></p>
            <div class="border rounded p-3 bg-light">
                {!! nl2br(e($planificacion->contenido ?? 'No especificado')) !!}
            </div>
        </div>
    </div>

    {{-- Card de Programas --}}
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-ul"></i> Programas de Asignatura</h5>
            
            @can('update', $planificacion)
                <a href="{{ route('docentes.programas.create', $planificacion) }}" class="btn btn-sm btn-light">
                    <i class="bi bi-plus-circle"></i> Agregar Programa
                </a>
            @endcan
        </div>

        <div class="card-body">
            @if($planificacion->programas->isEmpty())
                <p class="text-muted">No hay programas cargados aún.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Eje Temático</th>
                                <th>Unidad</th>
                                <th>Cuatrimestre</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($planificacion->programas as $programa)
                                <tr>
                                    <td>{{ $programa->eje_tematico }}</td>
                                    <td>{{ $programa->unidad }}</td>
                                    <td>{{ $programa->cuatrimestre }}</td>
                                    <td class="text-center">
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('docentes.programas.show', $programa) }}"
                                               class="btn text-primary border-0"
                                               style="background-color:#d0e5ff;">
                                                <i class="bi bi-eye me-1"></i> Ver
                                            </a>

                                            <a href="{{ route('docentes.programas.edit', [$planificacion, $programa]) }}"
                                               class="btn text-dark border-0"
                                               style="background-color:#fff3cd;">
                                                <i class="bi bi-pencil me-1"></i> Editar
                                            </a>

                                            <form action="{{ route('docentes.programas.destroy', [$planificacion, $programa]) }}"
                                                  method="POST" onsubmit="return confirm('¿Eliminar este programa?');"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn text-danger border-0"
                                                        style="background-color:#f8d7da;">
                                                    <i class="bi bi-trash me-1"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <a href="{{ route('docentes.planificaciones.index') }}" class="btn btn-outline-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection

