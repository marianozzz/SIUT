@extends('adminlte::page')

@section('title', 'Crear Permiso')

@section('content_header')
    <h1>Crear Nuevo Permiso</h1>
@stop

@section('content')
    <form action="{{ route('admin.permisos.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre del Permiso</label>
            <input type="text" name="name" class="form-control" placeholder="Ej: editar usuarios" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.permisos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
