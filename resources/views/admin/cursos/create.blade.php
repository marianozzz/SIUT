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
            <label for="nivel">Nivel (Ej: 4, 5, 6)</label>
            <input type="number" name="nivel" class="form-control" value="{{ old('nivel') }}" required>
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
            <label for="turno">Turno</label>
            <select name="turno" class="form-control" required>
                <option value="">Seleccione turno</option>
                <option value="Mañana">Mañana</option>
                <option value="Tarde">Tarde</option>
                <option value="Noche">Noche</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.cursos.index') }}" class="btn btn-secondary">Volver</a>
    </form>
@stop
