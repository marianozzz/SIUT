@extends('adminlte::page')

@section('title', 'Crear Rol')

@section('content_header')
    <h1>Crear Nuevo Rol</h1>
@stop

@section('content')
    <form action="{{ route('admin.roles.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre del Rol</label>
            <input type="text" name="name" class="form-control" placeholder="Nombre del rol" required>
        </div>

        <div class="form-group">
            <label>Permisos</label>
            <div class="row">
                @foreach ($permisos as $permiso)
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permiso->id }}">
                            {{ $permiso->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
