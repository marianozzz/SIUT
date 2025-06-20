@extends('adminlte::page')

@section('title', 'Detalles del Curso')

@section('content_header')
    <h1>
        Curso: {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
        (Turno: {{ $curso->turno ?? 'No definido' }})
    </h1>
    <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop

@section('content')
    <h3>Asignaturas Asignadas</h3>

    @if($curso->asignaturas->count())
        @php
            $asignaturasAgrupadas = $curso->asignaturas->groupBy('nombre');
            $idUnico = 0;
        @endphp

        <div class="accordion" id="accordionAsignaturas">
            @foreach($asignaturasAgrupadas as $nombre => $grupoAsignaturas)
                @php $idUnico++; @endphp
                <div class="card">
                    <div class="card-header bg-primary text-white" id="heading{{ $idUnico }}">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" data-toggle="collapse" data-target="#collapse{{ $idUnico }}" aria-expanded="true" aria-controls="collapse{{ $idUnico }}">
                                {{ $nombre }}
                            </button>
                        </h5>
                    </div>

                    <div id="collapse{{ $idUnico }}" class="collapse show" aria-labelledby="heading{{ $idUnico }}" data-parent="#accordionAsignaturas">
                        <div class="card-body p-0">
                            @php
                                // Agrupar internamente por grupo (A, B, etc.)
                                $porGrupo = $grupoAsignaturas->groupBy(fn($a) => $a->pivot->grupo ?? 'Sin grupo');
                            @endphp

                            @foreach($porGrupo as $grupoNombre => $asignaturasGrupo)
                                <div class="bg-light p-2 font-weight-bold border-top border-bottom">
                                    Grupo: {{ $grupoNombre }}
                                </div>

                                <table class="table table-bordered mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th style="width: 30%">Acciones</th>
                                            <th style="width: 35%">Profesor</th>
                                            <th style="width: 35%">Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($asignaturasGrupo as $asignatura)
                                            <tr>
                                                <td>
                                                    <a href="{{ route('admin.asignaturas.show', [$asignatura->id, $curso->id]) }}" class="btn btn-sm btn-info mb-1">
                                                        Ver programa
                                                    </a>
                                                </td>
                                                <td>
                                                    @if($asignatura->pivot->profesor_id)
                                                        @php
                                                            $profesor = \App\Models\Docente::find($asignatura->pivot->profesor_id);
                                                        @endphp
                                                        {{ $profesor->apellido }}, {{ $profesor->nombre }}
                                                    @else
                                                        <span class="text-muted">Sin profesor asignado</span><br>
                                                        <a href="{{ route('admin.asignaturas.asignar-docente', [$curso->id, $asignatura->id]) }}" class="btn btn-sm btn-warning mt-1">
                                                            Asignar docente
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    Tema: <strong>{{ $asignatura->pivot->tema ?? 'No definido' }}</strong><br>
                                                    @php
                                                        $turno = \App\Models\Turno::find($asignatura->pivot->turno_id);
                                                    @endphp
                                                    Turno: <strong>{{ $turno->nombre ?? 'No definido' }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Este curso no tiene asignaturas asignadas.</p>
    @endif
@stop
