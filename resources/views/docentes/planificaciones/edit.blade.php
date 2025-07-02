@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square"></i> Editar Planificación Anual
            </h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Revisá los errores:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('docentes.planificaciones.update', $planificacion) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Curso *</label>
                        <select name="curso_id" class="form-select" required>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ $planificacion->curso_id == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Asignatura *</label>
                        <select name="asignatura_id" class="form-select" required>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}" {{ $planificacion->asignatura_id == $asignatura->id ? 'selected' : '' }}>
                                    {{ $asignatura->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Año *</label>
                    <input type="number" name="fecha" class="form-control" min="2000" max="2099"
                        value="{{ old('fecha', $planificacion->fecha) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fundamentos, Objetivos, Contenidos Generales</label>
                    <textarea name="contenido" class="form-control" rows="6" required>{{ old('contenido', $planificacion->contenido) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('docentes.planificaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-check-circle"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


