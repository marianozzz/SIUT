@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0"><i class="bi bi-journal-bookmark"></i> Mis Planificaciones</h4>
        <a href="{{ route('docentes.planificaciones.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nueva Planificación
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($planificaciones->isEmpty())
        <p class="text-muted">No has registrado ninguna planificación aún.</p>
    @else
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Año</th>
                        <th>Curso</th>
                        <th>Asignatura</th>
                        <th class="text-end">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planificaciones as $planificacion)
                        <tr>
                            <td>{{ $planificacion->fecha }}</td>
                            <td>{{ $planificacion->curso->nivel }} {{ $planificacion->curso->division->nombre }}</td>
                            <td>{{ $planificacion->asignatura->nombre }}</td>
                            <td class="text-end">
                                <a href="{{ route('docentes.planificaciones.show', $planificacion) }}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Ver
                                </a>

                                @can('update', $planificacion)
                                    <a href="{{ route('docentes.planificaciones.edit', $planificacion) }}" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i> Editar
                                    </a>
                                @endcan

                                @can('delete', $planificacion)
                                    <form action="{{ route('docentes.planificaciones.destroy', $planificacion) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar esta planificación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="bi bi-trash"></i> Borrar
                                        </button>
                                    </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection


