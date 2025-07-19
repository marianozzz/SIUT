@extends('layouts.docentes')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">
                <i class="bi bi-clipboard-data me-2"></i>
                Detalle de Asistencia – {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
            </h4>
        </div>

        <div class="card-body">

            @if($resumen->isEmpty())
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle"></i> Aún no se tomaron asistencias en este curso.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha</th>
                                <th class="text-center">Presentes</th>
                                <th class="text-center">Ausentes</th>
                                <th class="text-center">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resumen as $dia)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($dia['fecha'])->format('d/m/Y') }}</td>
                                    <td class="text-center">{{ $dia['presentes'] }}</td>
                                    <td class="text-center">{{ $dia['ausentes'] }}</td>
                                    <td class="text-center">
                                        {{-- Botón para ver lista de alumnos presentes/ausentes --}}
                                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="collapse"
                                                data-bs-target="#detalle-{{ $dia['fecha'] }}">
                                            Ver
                                        </button>
                                    </td>
                                </tr>
                                {{-- Lista expandible --}}
                                <tr class="collapse" id="detalle-{{ $dia['fecha'] }}">
                                    <td colspan="4">
                                        <ul class="list-group">
                                            @foreach($dia['detalle'] as $asis)
                                                <li class="list-group-item d-flex justify-content-between">
                                                    {{ $asis->alumno->apellido }}, {{ $asis->alumno->nombre }}
                                                    <span class="badge {{ $asis->presente ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $asis->presente ? 'Presente' : 'Ausente' }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </div>
        <div class="card-footer text-end bg-white border-0">
            <a href="{{ route('docentes.cursos.show', $curso->id) }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Volver
            </a>
        </div>
    </div>
</div>
@endsection
