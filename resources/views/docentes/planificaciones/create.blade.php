@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-journal-plus"></i> Nueva Planificación Anual
            </h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Se encontraron errores:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('docentes.planificaciones.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Curso *</label>
                        <select name="curso_id" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            @foreach($cursos as $curso)
                                <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                                    {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Asignatura *</label>
                        <select name="asignatura_id" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}" {{ old('asignatura_id') == $asignatura->id ? 'selected' : '' }}>
                                    {{ $asignatura->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Año *</label>
                    <input type="number" name="fecha" class="form-control" min="2000" max="2099"
                        value="{{ old('fecha', now()->year) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Fundamentos, Objetivos, Propósitos, Estrategias, Contenidos Generales
                    </label>
                    <textarea name="contenido" class="form-control" rows="6" placeholder="Describa aquí la planificación general...">{{ old('contenido') }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('docentes.planificaciones.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-check-circle"></i> Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

