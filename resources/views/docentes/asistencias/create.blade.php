@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-check2-square me-2"></i> Tomar Asistencia - {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
            </h4>
        </div>

        <div class="card-body">
            <form action="{{ route('docentes.asistencias.store', $curso->id) }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="fecha" class="form-label"><strong>Fecha:</strong></label>
                    <input type="date" name="fecha" class="form-control" value="{{ $fechaHoy }}" required>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Alumno</th>
                                <th>Presente</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td>{{ $alumno->apellido }}, {{ $alumno->nombre }}</td>
                                    <td class="text-center">
                                        <input type="checkbox"
                                               name="asistencias[{{ $alumno->id }}]"
                                               value="1"
                                               checked>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Asistencia
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
