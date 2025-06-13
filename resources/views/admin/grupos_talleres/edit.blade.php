@extends('adminlte::page')

@section('title', 'Editar Grupo de Taller')

@section('content_header')
    <h1>Editar Grupo de Taller</h1>
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

    <form action="{{ route('admin.grupos.update', $grupo) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                {{-- Nombre del grupo --}}
                <div class="form-group">
                    <label for="nombre">Nombre del Grupo (Ej: A, B, C)</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $grupo->nombre) }}" required>
                </div>

                {{-- Mostrar o seleccionar asignaturaCurso --}}
                @if ($grupo->asignaturaCurso)
                    <div class="form-group">
                        <label>Curso</label>
                        <input type="text" class="form-control" 
                               value="{{ $grupo->asignaturaCurso->curso->nivel }} - {{ $grupo->asignaturaCurso->curso->division->nombre }}"
                               readonly>
                    </div>

                    <div class="form-group">
                        <label>Asignatura</label>
                        <input type="text" class="form-control" 
                               value="{{ $grupo->asignaturaCurso->asignatura->nombre }}"
                               readonly>
                    </div>

                    {{-- Campo oculto para enviar asignatura_curso_id --}}
                    <input type="hidden" name="asignatura_curso_id" value="{{ $grupo->asignatura_curso_id }}">
                @else
                    <div class="form-group">
                        <label for="asignatura_curso_id">Asignatura del Curso</label>
                        <select name="asignatura_curso_id" id="asignatura_curso_id" class="form-control" required>
                            <option value="">Seleccione una asignatura...</option>
                            @foreach ($asignaturasCursos as $ac)
                                <option value="{{ $ac->id }}"
                                    {{ old('asignatura_curso_id', $grupo->asignatura_curso_id) == $ac->id ? 'selected' : '' }}
                                    data-curso="{{ $ac->curso_id }}">
                                    {{ $ac->curso->nivel }} {{ $ac->curso->division->nombre }} - {{ $ac->asignatura->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Lista de alumnos --}}
                <div class="form-group">
                    <label>Alumnos del Curso</label>
                    <div id="alumnos-container" class="border rounded p-2 bg-light" style="max-height: 250px; overflow-y: auto;">
                        @forelse ($alumnosCurso as $alumno)
                            <div class="form-check">
                                <input type="checkbox"
                                       name="alumnos[]"
                                       value="{{ $alumno->id }}"
                                       id="alumno_{{ $alumno->id }}"
                                       class="form-check-input"
                                       {{ in_array($alumno->id, $alumnosGrupo) ? 'checked' : '' }}>
                                <label for="alumno_{{ $alumno->id }}" class="form-check-label">
                                    {{ $alumno->apellido }}, {{ $alumno->nombre }}
                                </label>
                            </div>
                        @empty
                            <p>No hay alumnos disponibles para este grupo.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.grupos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar Cambios
                </button>
            </div>
        </div>
    </form>
@stop

@section('js')
<script>
    // Si se puede cambiar la asignatura (cuando no está asignada)
    const asignaturaSelect = document.getElementById('asignatura_curso_id');
    const alumnosContainer = document.getElementById('alumnos-container');

    if (asignaturaSelect) {
        asignaturaSelect.addEventListener('change', function () {
            const asignaturaCursoId = this.value;

            if (!asignaturaCursoId) {
                alumnosContainer.innerHTML = '<p class="text-muted">Seleccione una asignatura para ver los alumnos.</p>';
                return;
            }

            // Obtener el curso_id desde la opción seleccionada
            const cursoId = this.options[this.selectedIndex].dataset.curso;

            if (!cursoId) {
                alumnosContainer.innerHTML = '<p class="text-danger">Error: la asignatura no tiene curso asociado.</p>';
                return;
            }

            fetch(`/admin/cursos/${cursoId}/alumnos`)
                .then(res => res.json())
                .then(data => {
                    if (data.length === 0) {
                        alumnosContainer.innerHTML = '<p>No hay alumnos en este curso.</p>';
                        return;
                    }

                    alumnosContainer.innerHTML = '';

                    data.forEach(alumno => {
                        const div = document.createElement('div');
                        div.classList.add('form-check');

                        const checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = 'alumnos[]';
                        checkbox.value = alumno.id;
                        checkbox.classList.add('form-check-input');
                        checkbox.id = 'alumno_' + alumno.id;

                        const label = document.createElement('label');
                        label.classList.add('form-check-label');
                        label.setAttribute('for', 'alumno_' + alumno.id);
                        label.textContent = alumno.apellido + ', ' + alumno.nombre;

                        div.appendChild(checkbox);
                        div.appendChild(label);
                        alumnosContainer.appendChild(div);
                    });
                })
                .catch(() => {
                    alumnosContainer.innerHTML = '<p class="text-danger">Error al cargar alumnos.</p>';
                });
        });
    }
</script>
@endsection

