@extends('adminlte::page')

@section('title', 'Crear Curso')

@section('content_header')
    <h1>Crear nuevo Curso</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.cursos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nivel">Nivel (Ej: 1 a 7)</label>
            <input type="number" name="nivel" class="form-control" value="{{ old('nivel') }}" min="1" max="7" required>
        </div>

        <div class="form-group">
            <label for="division_id">División</label>
            <select name="division_id" class="form-control" required>
                <option value="">Seleccione una división</option>
                @foreach($divisiones as $division)
                    <option value="{{ $division->id }}">{{ $division->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="ciclo_id">Ciclo</label>
            <select name="ciclo_id" class="form-control" required>
                <option value="">Seleccione un ciclo</option>
                @foreach($ciclos as $ciclo)
                    <option value="{{ $ciclo->id }}">{{ $ciclo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="especialidad-group" style="display: none;">
            <label for="especialidad_id">Especialidad (solo de 4° a 7°)</label>
            <select name="especialidad_id" class="form-control">
                <option value="">Seleccione una especialidad</option>
                @foreach($especialidades as $especialidad)
                    <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
@stop

@section('js')
<script>
    function toggleEspecialidad() {
        const nivelInput = document.querySelector('input[name="nivel"]');
        const especialidadGroup = document.getElementById('especialidad-group');

        const nivel = parseInt(nivelInput.value);
        if (!isNaN(nivel) && nivel >= 4) {
            especialidadGroup.style.display = 'block';
        } else {
            especialidadGroup.style.display = 'none';
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const nivelInput = document.querySelector('input[name="nivel"]');
        nivelInput.addEventListener('input', toggleEspecialidad);
        toggleEspecialidad();
    });
</script>
@endsection
