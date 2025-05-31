@extends('adminlte::page')

@section('title', 'Editar Categoría')

@section('content_header')
    <h1>Editar Categoría</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.categoriasasignaturas.update', $categorias_asignatura) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categorias_asignatura->nombre) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Actualizar
            </button>
            <a href="{{ route('admin.categoriasasignaturas.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
