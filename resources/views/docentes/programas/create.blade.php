@extends('layouts.docentes')

@section('content')
<!-- Trix CSS (sin integrity) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-plus-circle me-2"></i>
                Nuevo Programa para {{ $planificacion->asignatura->nombre }} -
                {{ $planificacion->curso->nivel }} {{ $planificacion->curso->division->nombre }}
            </h5>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <strong>Por favor corregí los siguientes errores:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('docentes.programas.store', $planificacion->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Eje Temático *</label>
                    <input type="text" name="eje_tematico" class="form-control"
                        placeholder="Ej: Educación ambiental, trigonometría, narrativa..." value="{{ old('eje_tematico') }}" required>
                    <small class="text-muted">Definí el eje principal de los contenidos trabajados.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Unidad *</label>
                    <input type="text" name="unidad" class="form-control"
                        placeholder="Ej: Unidad 1: Introducción a..." value="{{ old('unidad') }}" required>
                    <small class="text-muted">Identificá la unidad temática del programa.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Cuatrimestre *</label>
                    <select name="cuatrimestre" class="form-select" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="1" {{ old('cuatrimestre') == '1' ? 'selected' : '' }}>1° Cuatrimestre</option>
                        <option value="2" {{ old('cuatrimestre') == '2' ? 'selected' : '' }}>2° Cuatrimestre</option>
                    </select>
                    <small class="text-muted">Seleccioná el cuatrimestre correspondiente.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Contenidos *</label>
                    <input id="contenido" type="hidden" name="contenidos" value="{{ old('contenidos') }}">
                    <trix-editor input="contenido"></trix-editor>
                    <small class="text-muted">Escribí los contenidos detallados del programa. Podés usar negrita, listas y enlaces.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Actividades</label>
                    <textarea name="actividades" class="form-control" rows="3"
                        placeholder="Ej: Debates, ejercicios prácticos, exposiciones...">{{ old('actividades') }}</textarea>
                    <small class="text-muted">Opcional: describí actividades relevantes para este programa.</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('docentes.planificaciones.show', $planificacion->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Guardar Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

