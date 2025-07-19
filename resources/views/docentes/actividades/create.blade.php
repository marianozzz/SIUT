@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center">
        <i class="bi bi-folder-plus text-info me-2"></i> Nueva Actividad
    </h2>

    <form action="{{ route('docentes.actividades.store') }}" method="POST">
        @csrf

        {{-- Título --}}
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" id="titulo" class="form-control" required value="{{ old('titulo') }}">
        </div>

        {{-- Descripción (opcional) --}}
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción (opcional)</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ old('descripcion') }}">
            <div class="form-text">Breve resumen del contenido o propósito de la actividad.</div>
        </div>

        {{-- Contenido con Trix --}}
        <div class="mb-3">
            <label for="contenido" class="form-label">Contenido</label>
            <input id="contenido" type="hidden" name="contenido" value="{{ old('contenido') }}">
            <trix-editor input="contenido"></trix-editor>
        </div>

        {{-- Selección de cursos (opcional) --}}
        <div class="mb-3">
            <label for="cursos" class="form-label">Asignar a cursos (opcional)</label>
            <select name="cursos[]" id="cursos" class="form-select" multiple>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}">
                        {{ $curso->nivel }} {{ $curso->division->nombre }}
                    </option>
                @endforeach
            </select>
            <div class="form-text">Podés dejar vacío si la actividad no está asignada.</div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-save"></i> Guardar Actividad
            </button>
        </div>
    </form>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.umd.min.js"></script>
@endpush

