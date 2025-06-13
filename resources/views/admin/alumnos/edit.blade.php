@extends('adminlte::page')

@section('title', 'Editar Alumno')

@section('content_header')
    <h1>Editar Alumno</h1>
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

    <form action="{{ route('admin.alumnos.update', $alumno) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $alumno->nombre) }}" required>
        </div>

        <div class="form-group">
            <label for="apellido">Apellido *</label>
            <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $alumno->apellido) }}" required>
        </div>

        <div class="form-group">
            <label for="dni">DNI *</label>
            <input type="text" name="dni" class="form-control" value="{{ old('dni', $alumno->dni) }}" required>
        </div>

        <div class="form-group">
            <label for="fecha_nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento', $alumno->fecha_nacimiento) }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $alumno->email) }}">
        </div>

        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $alumno->telefono) }}">
        </div>

        <div class="form-group">
            <label for="domicilio">Domicilio</label>
            <input type="text" name="domicilio" class="form-control" value="{{ old('domicilio', $alumno->domicilio) }}">
        </div>

        <div class="form-group">
            <label for="cursos">Cursos</label>
            <select name="cursos[]" class="form-control" multiple>
                @foreach ($cursos as $curso)
                    <option value="{{ $curso->id }}"
                        {{ in_array($curso->id, old('cursos', $alumno->cursos->pluck('id')->toArray())) ? 'selected' : '' }}>
                        {{ $curso->nivel }} {{ $curso->division->nombre ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar
        </button>
        <a href="{{ route('admin.alumnos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
