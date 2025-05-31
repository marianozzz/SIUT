@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1>Editar Rol</h1>
@stop

@section('content')
    <form action="{{ route('admin.roles.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre del Rol</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $rol->name) }}" required>
        </div>

        <div class="form-group">
            <label>Permisos</label>
            <div class="row">
                @foreach ($permisos as $permiso)
                    <div class="col-md-3">
                        <label>
                            <input type="checkbox" name="permissions[]" value="{{ $permiso->id }}"
                                {{ $rol->permissions->contains($permiso) ? 'checked' : '' }}>
                            {{ $permiso->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@stop
