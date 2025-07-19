@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">
                <i class="bi bi-list-check me-2"></i>
                Detalle de Asistencias – {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
            </h4>
        </div>

        <div class="card-body">
            @if($fechas->isEmpty())
                <div class="alert alert-info text-center">
                    No se registraron asistencias para este curso.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-light">
                            <tr>
                                <th class="text-start">Alumno</th>
                                @foreach($fechas as $fecha)
                                    <th>{{ \Carbon\Carbon::parse($fecha)->format('d/m') }}</th>
                                @endforeach
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($alumnos as $alumno)
                                <tr>
                                    <td class="text-start">
                                        {{ $alumno->apellido }}, {{ $alumno->nombre }}
                                    </td>

                                    @foreach($fechas as $fecha)
                                        @php
                                            $reg = $alumno->asistencias
                                                ->firstWhere('fecha', $fecha);
                                        @endphp
                                        <td>
                                            @if($reg)
                                                {!! $reg->presente ? '✅' : '❌' !!}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="card-footer bg-white text-end">
            <a href="{{ route('docentes.cursos.show', $curso->id) }}"
               class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver al Curso
            </a>
        </div>
    </div>
</div>
@endsection
