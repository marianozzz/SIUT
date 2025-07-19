@extends('adminlte::page')

@section('title', 'Editar Solicitud')

@section('content_header')
    <h1>Editar Solicitud #{{ $solicitud->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.solicitudes.update', $solicitud) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Tipo de solicitud -->
                <div class="mb-3">
                    <label for="tipo_solicitud_id" class="form-label">Tipo de Solicitud</label>
                    <select name="tipo_solicitud_id" id="tipo_solicitud_id" class="form-control" required>
                        @foreach($tipos as $tipo)
                            <option value="{{ $tipo->id }}" @selected($tipo->id == $solicitud->tipo_solicitud_id)>
                                {{ $tipo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Alumno -->
                <div class="mb-3">
                    <label for="alumno_id" class="form-label">Alumno</label>
                    <select name="alumno_id" id="alumno_id" class="form-control">
                        <option value="">-- Sin alumno --</option>
                        @foreach($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" @selected($alumno->id == $solicitud->alumno_id)>
                                {{ $alumno->apellido }}, {{ $alumno->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Docente -->
                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-control">
                        <option value="">-- Sin docente --</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" @selected($docente->id == $solicitud->docente_id)>
                                {{ $docente->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Motivo -->
                <div class="mb-3">
                    <label for="motivo" class="form-label">Motivo</label>
                    <textarea name="motivo" id="motivo" class="form-control" rows="3" required>{{ old('motivo', $solicitud->motivo) }}</textarea>
                </div>

                <!-- Estado -->
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="pendiente" @selected($solicitud->estado === 'pendiente')>Pendiente</option>
                        <option value="aprobada" @selected($solicitud->estado === 'aprobada')>Aprobada</option>
                        <option value="rechazada" @selected($solicitud->estado === 'rechazada')>Rechazada</option>
                    </select>
                </div>

                <!-- Respuesta -->
                <div class="mb-3">
                    <label for="respuesta" class="form-label">Respuesta (opcional)</label>
                    <textarea name="respuesta" id="respuesta" class="form-control" rows="3">{{ old('respuesta', $solicitud->respuesta) }}</textarea>
                </div>

                <!-- Archivo -->
                @if($solicitud->archivo)
                    <div class="mb-3">
                        <label class="form-label">Archivo actual:</label>
                        <a href="{{ Storage::url($solicitud->archivo) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            Ver archivo
                        </a>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="archivo" class="form-label">Reemplazar archivo (opcional)</label>
                    <input type="file" name="archivo" id="archivo" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">
                    Guardar Cambios
                </button>

                <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </form>
        </div>
    </div>
@stop
