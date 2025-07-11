@extends('adminlte::page')

@section('title', 'Crear Asignatura')

@section('content_header')
    <h1>Crear nueva asignatura</h1>
    <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop

@section('content')
    <form action="{{ route('admin.asignaturas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre *</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            @error('nombre')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            @error('descripcion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="categoria_asignatura_id">Categoría</label>
            <select name="categoria_asignatura_id" class="form-control">
                <option value="">-- Seleccionar categoría --</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_asignatura_id') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            @error('categoria_asignatura_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Guardar</button>
    </form>
@stop
