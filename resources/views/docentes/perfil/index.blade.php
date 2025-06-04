@extends('layouts.docente')

@section('content')
<div class="row">
    <!-- Panel lateral con información personal -->
    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-person-circle me-2"></i>Información Personal</h5>
            </div>
            <div class="card-body">
                <p><strong>Nombre:</strong> {{ $docente->nombre_completo }}</p>
                <p><strong>DNI:</strong> {{ $docente->dni }}</p>
                <p><strong>Email:</strong> {{ $docente->usuario->email }}</p>
                <p><strong>Teléfono:</strong> {{ $docente->telefono ?? 'No registrado' }}</p>
                <p><strong>Dirección:</strong> {{ $docente->direccion ?? 'No registrada' }}</p>
            </div>
        </div>
    </div>

    <!-- Panel principal con información académica y cursos -->
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="bi bi-mortarboard-fill me-2"></i>Datos Académicos</h5>
            </div>
            <div class="card-body">
                <p><strong>Especialidad:</strong> {{ $docente->especialidad ?? 'No registrada' }}</p>
                <p><strong>Grado académico:</strong> {{ $docente->grado ?? 'No registrado' }}</p>
                <p><strong>Años de experiencia:</strong> {{ $docente->experiencia ?? 'No disponible' }}</p>
                <p><strong>Fecha de ingreso:</strong> {{ optional($docente->fecha_ingreso)->format('d/m/Y') ?? 'No disponible' }}</p>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="bi bi-journal-bookmark-fill me-2"></i>Cursos Asignados</h5>
            </div>
            <div class="card-body">
                @if($docente->cursos && $docente->cursos->count())
                    <ul class="list-group">
                        @foreach ($docente->cursos as $curso)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $curso->nombre }} - {{ $curso->grado }}
                                <span class="badge bg-primary">{{ $curso->anio }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No tienes cursos asignados actualmente.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

