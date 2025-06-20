@extends('adminlte::page')

@section('title', 'Asignaturas por Curso')

@section('content_header')
    <h1>Asignaciones de Asignaturas a Cursos</h1>
@stop

@section('content')
    <a href="{{ route('admin.asignatura-cursos.create') }}" class="btn btn-success mb-3">Nueva Asignación</a>

    {{-- Filtros automáticos --}}
    <form method="GET" action="{{ route('admin.asignatura-cursos.index') }}" class="mb-4 row" id="filtroForm">
        <div class="col-md-3">
            <label>Curso</label>
            <select name="curso_id" class="form-control filtro-auto">
                <option value="">-- Todos --</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ request('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nivel }}° {{ $curso->division->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Asignatura</label>
            <select name="asignatura_id" class="form-control filtro-auto">
                <option value="">-- Todas --</option>
                @foreach($asignaturas as $asignatura)
                    <option value="{{ $asignatura->id }}" {{ request('asignatura_id') == $asignatura->id ? 'selected' : '' }}>
                        {{ $asignatura->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label>Docente</label>
            <select name="profesor_id" class="form-control filtro-auto">
                <option value="">-- Todos --</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ request('profesor_id') == $docente->id ? 'selected' : '' }}>
                        {{ $docente->nombre_completo }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    {{-- Tabla --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Curso</th>
                    <th>Asignatura</th>
                    <th>Docente</th>
                    <th>Turno</th>
                    <th>Tema</th>
                    <th>Horarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($asignaturaCursos as $asignacion)
                    <tr>
                        <td>{{ $asignacion->curso->nivel }}° {{ $asignacion->curso->division->nombre }}</td>
                        <td>{{ $asignacion->asignatura->nombre }}</td>
                        <td>{{ $asignacion->profesor->nombre_completo ?? 'Sin asignar' }}</td>
                        <td>{{ $asignacion->turno->nombre ?? '—' }}</td>
                        <td>{{ $asignacion->tema ?? '—' }}</td>
                        <td>
                            @forelse($asignacion->horarios as $horario)
                                <div>
                                    {{ ucfirst($horario->dia) }}:
                                    {{ \Carbon\Carbon::parse($horario->hora_entrada)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($horario->hora_salida)->format('H:i') }}
                                </div>
                            @empty
                                <span class="text-muted">Sin horarios</span>
                            @endforelse
                        </td>
                        <td>
                            <a href="{{ route('admin.asignatura-cursos.edit', $asignacion->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('admin.asignatura-cursos.destroy', $asignacion->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('¿Está seguro?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7">No hay asignaciones registradas.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{-- Paginación --}}
        {{ $asignaturaCursos->appends(request()->query())->links() }}
    </div>
@stop

@section('js')
    <script>
        document.querySelectorAll('.filtro-auto').forEach(select => {
            select.addEventListener('change', () => {
                document.getElementById('filtroForm').submit();
            });
        });
    </script>
@stop

