@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">
                <i class="bi bi-pencil-square me-2"></i> Cargar Calificaciones - {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('docentes.calificaciones.store', $curso->id) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="fecha" class="form-label"><strong>Fecha:</strong></label>
                        <input type="date" name="fecha" class="form-control" value="{{ now()->toDateString() }}" required>
                    </div>
                    <div class="col-md-4">
                        <label for="asignatura_id" class="form-label"><strong>Asignatura:</strong></label>
                        <select name="asignatura_id" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            @foreach($asignaturas as $asignatura)
                                <option value="{{ $asignatura->id }}">{{ $asignatura->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion" class="form-label"><strong>Descripción (opcional):</strong></label>
                        <input type="text" name="descripcion" class="form-control" placeholder="Ej: Examen Parcial 1">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Alumno</th>
                                <th>Nota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td>{{ $alumno->apellido }}, {{ $alumno->nombre }}</td>
                                    <td>
                                        <input type="number"
                                               name="notas[{{ $alumno->id }}]"
                                               class="form-control"
                                               min="1" max="10"
                                               step="0.1"
                                               placeholder="Ej: 7.5">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Guardar Calificaciones
                    </button>
                    <a href="{{ route('docentes.cursos.show', $curso->id) }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
