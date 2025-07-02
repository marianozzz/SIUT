@extends('layouts.docentes')

@section('content')
<!-- Trix CSS (sin integrity para evitar errores) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i>
                Editar Programa de {{ $planificacion->asignatura->nombre }} -
                {{ $planificacion->curso->nivel }} {{ $planificacion->curso->division->nombre }}
            </h5>
        </div>

        <div class="card-body">
            {{-- Validaciones --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('docentes.programas.update', $programa->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">Eje Temático *</label>
                    <input type="text" name="eje_tematico" class="form-control"
                        value="{{ old('eje_tematico', $programa->eje_tematico) }}"
                        placeholder="Ej: Lógica computacional, estructuras condicionales..." required>
                    <small class="text-muted">Definí el eje principal del programa.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Unidad *</label>
                    <input type="text" name="unidad" class="form-control"
                        value="{{ old('unidad', $programa->unidad) }}"
                        placeholder="Ej: Unidad 2: Condicionales en C" required>
                    <small class="text-muted">Identificá la unidad temática.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Cuatrimestre *</label>
                    <select name="cuatrimestre" class="form-select" required>
                        <option value="">-- Seleccionar --</option>
                        <option value="1" {{ old('cuatrimestre', $programa->cuatrimestre) == '1' ? 'selected' : '' }}>1° Cuatrimestre</option>
                        <option value="2" {{ old('cuatrimestre', $programa->cuatrimestre) == '2' ? 'selected' : '' }}>2° Cuatrimestre</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Contenidos *</label>
                    <input id="contenido" type="hidden" name="contenidos" value="{{ old('contenidos', $programa->contenidos) }}">
                    <trix-editor input="contenido"></trix-editor>
                    <small class="text-muted">Describí los contenidos detalladamente. Podés usar negritas, listas, etc.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Actividades</label>
                    <textarea name="actividades" class="form-control" rows="3"
                        placeholder="Ej: Desarrollo de ejercicios, presentación de proyectos, prácticas en C...">{{ old('actividades', $programa->actividades) }}</textarea>
                    <small class="text-muted">Opcional: actividades relevantes relacionadas al contenido.</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('docentes.planificaciones.show', $planificacion->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Actualizar Programa
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Trix JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>
@endsection
