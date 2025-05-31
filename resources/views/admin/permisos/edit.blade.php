@extends('adminlte::page')

@section('title', 'Editar Permiso')

@section('content_header')
    <h1>Editar Permiso</h1>
@stop

@section('content')
    <form action="{{ route('admin.permisos.update', $permiso) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre del Permiso</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permiso->name) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.permisos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
