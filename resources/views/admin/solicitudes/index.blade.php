@extends('adminlte::page')

@section('title', 'Solicitudes')

@section('content_header')
    <h1>Solicitudes</h1>
@stop

@section('content')
    <a href="{{ route('admin.solicitudes.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Nueva Solicitud
    </a>

    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Alumno</th>
                        <th>Docente</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->tipo->nombre }}</td>
                            <td>{{ $solicitud->alumno?->apellido }}, {{ $solicitud->alumno?->nombre }}</td>
                            <td>{{ $solicitud->docente?->user->name ?? '-' }}</td>
                            <td>
                                <span class="badge bg-{{ $solicitud->estado === 'pendiente' ? 'warning' : ($solicitud->estado === 'aprobada' ? 'success' : 'danger') }}">
                                    {{ ucfirst($solicitud->estado) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.solicitudes.show', $solicitud->id) }}" class="btn btn-sm btn-info">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No hay solicitudes registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
