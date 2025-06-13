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
            <div class="card-body">

                <div class="form-group">
                    <label for="nombre">Nombre del Grupo (Ej: Grupo A, Grupo B)</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>

                {{-- Curso para cargar alumnos --}}
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

                {{-- AsignaturaCurso que se guarda realmente --}}
                <div class="form-group">
                    <label for="asignatura_curso_id">Asignatura</label>
                    <select name="asignatura_curso_id" id="asignatura_curso_id" class="form-control" required>
                        <option value="">Seleccione una asignatura</option>
                        @foreach ($asignaturasCursos as $ac)
                            <option value="{{ $ac->id }}" data-curso="{{ $ac->curso_id }}">
                                {{ $ac->asignatura->nombre }} ({{ $ac->curso->nivel }} {{ $ac->curso->division->nombre }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Lista de alumnos --}}
                <div class="form-group">
                    <label>Alumnos del curso</label>
                    <div id="alumnos-container" class="border rounded p-2 bg-light">
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
    const asignaturaSelect = document.getElementById('asignatura_curso_id');
    const alumnosContainer = document.getElementById('alumnos-container');

    cursoSelect.addEventListener('change', function () {
        const cursoId = this.value;

        // Filtrar asignaturas para el curso seleccionado
        Array.from(asignaturaSelect.options).forEach(opt => {
            if (!opt.value) return;
            opt.style.display = (opt.dataset.curso == cursoId) ? 'block' : 'none';
        });

        asignaturaSelect.value = '';

        if (!cursoId) {
            alumnosContainer.innerHTML = '<p class="text-muted">Seleccione un curso para ver sus alumnos.</p>';
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
                    label.textContent = alumno.nombre_completo;

                    div.appendChild(checkbox);
                    div.appendChild(label);
                    alumnosContainer.appendChild(div);
                });
            })
            .catch(() => {
                alumnosContainer.innerHTML = '<p class="text-danger">Error al cargar alumnos.</p>';
            });
    });
</script>
@endsection


