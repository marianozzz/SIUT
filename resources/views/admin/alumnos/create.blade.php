@extends('adminlte::page')

@section('title', 'Nuevo Alumno')

@section('content_header')
    <h1>Registrar Nuevo Alumno</h1>
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

    <form action="{{ route('admin.alumnos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido *</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI *</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}">
        </div>

        <div class="form-group">
            <label for="sexo">Sexo</label>
            <select name="sexo" class="form-control">
                <option value="">-- Seleccionar --</option>
                <option value="Masculino" {{ old('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                <option value="Femenino" {{ old('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                <option value="Otro" {{ old('sexo') == 'Otro' ? 'selected' : '' }}>Otro</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nacionalidad">Nacionalidad</label>
            <input type="text" name="nacionalidad" class="form-control" value="{{ old('nacionalidad') }}">
        </div>

        <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
        </div>

        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control" value="{{ old('domicilio') }}">
        </div>

        <div class="form-group">
            <label for="curso_id">Curso</label>
            <select name="curso_id" class="form-control">
                <option value="">-- Sin asignar --</option>
                @foreach($cursos as $curso)
                    <option value="{{ $curso->id }}" {{ old('curso_id') == $curso->id ? 'selected' : '' }}>
                        {{ $curso->nivel }} {{ $curso->division->nombre }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Este campo es opcional. Puedes asignar el curso luego.</small>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar Alumno
        </button>
        <a href="{{ route('admin.alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
