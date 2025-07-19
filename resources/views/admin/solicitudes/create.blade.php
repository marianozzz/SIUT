@extends('adminlte::page')

@section('title', 'Nueva Solicitud')

@section('content_header')
    <h1>Crear Solicitud</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.solicitudes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tipo de solicitud -->
                <div class="mb-3">
                    <label for="tipo_solicitud_id" class="form-label">Tipo de Solicitud</label>
                    <select name="tipo_solicitud_id" id="tipo_solicitud_id" class="form-control" required>
                        <option value="">Seleccione un tipo</option>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Alumno -->
                <div class="mb-3">
                    <label for="alumno_id" class="form-label">Alumno (opcional)</label>
                    <select name="alumno_id" id="alumno_id" class="form-control">
                        <option value="">-- Seleccione --</option>
                        @foreach($alumnos as $alumno)
                            <option value="{{ $alumno->id }}">{{ $alumno->apellido }}, {{ $alumno->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Docente -->
                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente (opcional)</label>
                    <select name="docente_id" id="docente_id" class="form-control">
                        <option value="">-- Seleccione --</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }}, {{ $docente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Motivo -->
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <textarea name="motivo" id="motivo" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Archivo adjunto -->
                <div class="mb-3">
                    <label for="archivo" class="form-label">Archivo Adjunto (opcional)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    Guardar Solicitud
                </button>

                <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>

        </div>
    </div>
@stop
