@extends('adminlte::page')

@section('title', 'Nueva Categoría de Asignatura')

@section('content_header')
    <h1>Crear Categoría de Asignatura</h1>
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

    <form action="{{ route('admin.categoriasasignaturas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Guardar</button>
        <a href="{{ route('admin.categoriasasignaturas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@stop
