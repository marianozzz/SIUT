@extends('adminlte::page')

@section('title', 'Crear Curso')

@section('content_header')
    <h1>Nuevo Curso</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cursos.store') }}" method="POST">
        @csrf

        <div class="card">
            <div class="card-body">

                {{-- Nivel --}}
                <div class="form-group">
                    <label for="nivel">Nivel del curso <small>(1º a 7º)</small></label>
                    <input type="number" name="nivel" id="nivel" class="form-control" 
                           value="{{ old('nivel') }}" min="1" max="7" required>
                </div>

                {{-- División --}}
                <div class="form-group">
                    <label for="division_id">División</label>
                    <select name="division_id" id="division_id" class="form-control" required>
                        <option value="">Seleccione una división</option>
                        @foreach($divisiones as $division)
                            <option value="{{ $division->id }}" 
                                    {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                {{ $division->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Ciclo --}}
                <div class="form-group">
                    <label for="ciclo_id">Ciclo Lectivo</label>
                    <select name="ciclo_id" id="ciclo_id" class="form-control" required>
                        <option value="">Seleccione un ciclo</option>
                        @foreach($ciclos as $ciclo)
                            <option value="{{ $ciclo->id }}" 
                                    {{ old('ciclo_id') == $ciclo->id ? 'selected' : '' }}>
                                {{ $ciclo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Especialidad --}}
                <div class="form-group" id="especialidad-group" style="display: none;">
                    <label for="especialidad_id">Especialidad <small>(solo desde 4º año)</small></label>
                    <select name="especialidad_id" id="especialidad_id" class="form-control">
                        <option value="">Seleccione una especialidad</option>
                        @foreach($especialidades as $especialidad)
                            <option value="{{ $especialidad->id }}" 
                                    {{ old('especialidad_id') == $especialidad->id ? 'selected' : '' }}>
                                {{ $especialidad->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Guardar Curso
                </button>
            </div>
        </div>
    </form>
@stop

@section('js')
<script>
    function toggleEspecialidad() {
        const nivel = parseInt(document.getElementById('nivel').value);
        const especialidadGroup = document.getElementById('especialidad-group');

        if (!isNaN(nivel) && nivel >= 4) {
            especialidadGroup.style.display = 'block';
        } else {
            especialidadGroup.style.display = 'none';
            document.getElementById('especialidad_id').value = ''; // limpiar si se oculta
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const nivelInput = document.getElementById('nivel');
        nivelInput.addEventListener('input', toggleEspecialidad);
        toggleEspecialidad(); // inicial
    });
</script>
@endsection
