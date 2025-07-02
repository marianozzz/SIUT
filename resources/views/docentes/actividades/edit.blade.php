@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        <i class="bi bi-pencil-square text-warning me-2"></i> Editar Actividad
    </h2>

    <form action="{{ route('docentes.actividades.update', $actividad) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Título --}}
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo', $actividad->titulo) }}"
                required
            >
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Contenido con Trix --}}
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <input id="contenido" type="hidden" name="contenido" value="{{ old('contenido', $actividad->contenido) }}">
            <trix-editor input="contenido"></trix-editor>
            @error('contenido')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        {{-- Cursos (selección múltiple) --}}
        <div class="mb-3">
            <label for="cursos" class="form-label">Asignar a cursos (opcional)</label>
            <select name="cursos[]" id="cursos" class="form-select" multiple>
                @foreach($cursos as $curso)
                    <option
                        value="{{ $curso->id }}"
                        @if(in_array($curso->id, old('cursos', $actividad->cursos->pluck('id')->toArray()))) selected @endif
                    >
                        {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Dejar vacío si no querés asignar a ningún curso.</div>
        </div>

        <div class="text-end">
            <a href="{{ route('docentes.actividades.index') }}" class="btn btn-outline-secondary me-2">
                <i class="bi bi-arrow-left"></i> Cancelar
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="bi bi-save"></i> Guardar cambios
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css" />
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.umd.min.js"></script>
@endpush
