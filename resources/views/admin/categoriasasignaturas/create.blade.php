@extends('adminlte::page')

@section('title', 'Nueva Categoría de Asignatura')

@section('content_header')
    <h1>Crear Nueva Categoría</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categoriasasignaturas.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Guardar
            </button>
            <a href="{{ route('admin.categoriasasignaturas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
