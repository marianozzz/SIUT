@extends('adminlte::page')

@section('title', 'Editar Categoría de Asignatura')

@section('content_header')
    <h1>Editar Categoría de Asignatura</h1>
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

    <form action="{{ route('admin.categoriasasignaturas.update', $categoriaAsignatura) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoriaAsignatura->nombre) }}" required>
        </div>

        <div class="form-group mt-3">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="4">{{ old('descripcion', $categoriaAsignatura->descripcion) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
        <a href="{{ route('admin.categoriasasignaturas.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
@stop
