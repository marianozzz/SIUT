@extends('adminlte::page')

@section('title', 'Nuevo Grupo de Taller')

@section('content_header')
    <h1>Crear Grupo de Taller</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.grupos.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body bg-light">
                {{-- Nombre del grupo --}}
                <div class="form-group">
                    <label for="nombre">Nombre del Grupo (Ej: Grupo A, Grupo B)</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                {{-- Curso --}}
                <div class="form-group">
                    <label for="curso_id">Curso</label>
                    <select name="curso_id" id="curso_id" class="form-control" required>
                        <option value="">Seleccione un curso</option>
                        @foreach ($cursos as $curso)
                            <option value="{{ $curso->id }}">
                                {{ $curso->nivel }} - {{ $curso->division->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Asignatura única --}}
                <div class="form-group">
                    <label for="asignatura_id">Asignatura</label>
                    <select id="asignatura_id" class="form-control" required>
                        <option value="">Seleccione una asignatura</option>
                        @php
                            $unicas = collect($asignaturasCursos)
                                ->unique(fn($ac) => $ac->asignatura_id)
                                ->values();
                        @endphp
                        @foreach ($unicas as $ac)
                            <option value="{{ $ac->asignatura_id }}">{{ $ac->asignatura->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Grupos disponibles (asignatura_curso) --}}
                <div class="form-group">
                    <label for="asignatura_curso_id">Grupo disponible</label>
                    <select name="asignatura_curso_id" id="asignatura_curso_id" class="form-control" required>
                        <option value="">Seleccione una asignatura primero</option>
                        @foreach ($asignaturasCursos as $ac)
                            <option value="{{ $ac->id }}"
                                data-asignatura="{{ $ac->asignatura_id }}"
                                data-info="{{ $ac->profesor->nombre_completo ?? 'Sin docente' }}|{{ $ac->turno->nombre ?? '-' }}|{{ $ac->curso->nivel }} {{ $ac->curso->division->nombre }}|{{ implode(';', $ac->horarios->map(fn($h) => ucfirst($h->dia).' '.\Carbon\Carbon::parse($h->hora_entrada)->format('H:i').'-'.\Carbon\Carbon::parse($h->hora_salida)->format('H:i'))->toArray()) }}"
                                style="display: none;">
                                {{ $ac->asignatura->nombre }} - {{ $ac->profesor->nombre_completo ?? 'Sin docente' }} ({{ $ac->curso->nivel }} {{ $ac->curso->division->nombre }})
                            </option>
                        @endforeach
                    </select>

                    <div id="grupo-info" class="mt-3 p-3 rounded bg-white border-start border-primary border-4">
                        <p><strong>Docente:</strong> <span id="grupo-docente">-</span></p>
                        <p><strong>Turno:</strong> <span id="grupo-turno">-</span></p>
                        <p><strong>Curso:</strong> <span id="grupo-curso">-</span></p>
                        <p><strong>Horarios:</strong></p>
                        <div id="grupo-horarios" class="d-flex flex-wrap gap-2"></div>
                    </div>
                </div>

                {{-- Alumnos --}}
                <div class="form-group">
                    <label>Alumnos del curso</label>
                    <div id="alumnos-container" class="border rounded p-2 bg-white">
                        <p class="text-muted">Seleccione un curso para ver sus alumnos.</p>
                    </div>
                </div>
            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.grupos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
            </div>
        </div>
    </form>
@stop

@section('js')
<script>
    const cursoSelect = document.getElementById('curso_id');
    const asignaturaSelect = document.getElementById('asignatura_id');
    const grupoSelect = document.getElementById('asignatura_curso_id');
    const grupoDocente = document.getElementById('grupo-docente');
    const grupoTurno = document.getElementById('grupo-turno');
    const grupoCurso = document.getElementById('grupo-curso');
    const grupoHorarios = document.getElementById('grupo-horarios');
    const alumnosContainer = document.getElementById('alumnos-container');

    // Al cambiar curso, cargar alumnos
    cursoSelect.addEventListener('change', function () {
        const cursoId = this.value;
        if (!cursoId) {
            alumnosContainer.innerHTML = '<p class="text-muted">Seleccione un curso para ver sus alumnos.</p>';
            return;
        }

        fetch(`/admin/cursos/${cursoId}/alumnos`)
            .then(res => res.json())
            .then(data => {
                alumnosContainer.innerHTML = '';
                if (!data.length) {
                    alumnosContainer.innerHTML = '<p>No hay alumnos en este curso.</p>';
                    return;
                }
                data.forEach(alumno => {
                    const div = document.createElement('div');
                    div.classList.add('form-check');
                    div.innerHTML = `
                        <input class="form-check-input" type="checkbox" name="alumnos[]" value="${alumno.id}" id="alumno_${alumno.id}">
                        <label class="form-check-label" for="alumno_${alumno.id}">${alumno.nombre_completo}</label>
                    `;
                    alumnosContainer.appendChild(div);
                });
            })
            .catch(() => {
                alumnosContainer.innerHTML = '<p class="text-danger">Error al cargar alumnos.</p>';
            });
    });

    // Mostrar solo los grupos que coinciden con la asignatura
    asignaturaSelect.addEventListener('change', function () {
        const asignaturaId = this.value;
        grupoSelect.value = '';
        grupoDocente.textContent = '-';
        grupoTurno.textContent = '-';
        grupoCurso.textContent = '-';
        grupoHorarios.innerHTML = '';

        Array.from(grupoSelect.options).forEach(opt => {
            if (!opt.value) return;
            opt.style.display = opt.dataset.asignatura === asignaturaId ? 'block' : 'none';
        });
    });

    // Mostrar info del grupo seleccionado
    grupoSelect.addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        const [docente, turno, curso, horariosRaw] = (selected.dataset.info || '').split('|');

        grupoDocente.textContent = docente || '-';
        grupoTurno.textContent = turno || '-';
        grupoCurso.textContent = curso || '-';

        const colorPorDia = {
            'Lunes': 'bg-primary text-white',
            'Martes': 'bg-warning text-dark',
            'Miércoles': 'bg-success text-white',
            'Jueves': 'bg-danger text-white',
            'Viernes': 'bg-purple text-white',
            'Sábado': 'bg-secondary text-white',
            'Domingo': 'bg-dark text-white'
        };

        grupoHorarios.innerHTML = horariosRaw?.split(';').filter(Boolean).map(h => {
            const [dia, hora] = h.trim().split(' ', 2);
            const color = colorPorDia[dia] || 'bg-light text-dark';
            return `<span class="badge ${color} me-2 mb-2">${h.trim()}</span>`;
        }).join('') || '';
    });
</script>
@endsection
