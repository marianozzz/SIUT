@extends('adminlte::page')

@section('title', 'Nueva Asignatura')

@section('content_header')
    <h1>Crear Nueva Asignatura</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.asignaturas.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre de la Asignatura</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                    @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="categoria_asignatura_id" class="form-label">Tipo de Asignatura</label>
                    <select name="categoria_asignatura_id" class="form-control">
                        <option value="">-- Seleccione un tipo --</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ old('categoria_asignatura_id') == $categoria->id ? 'selected' : '' }}>
                                {{ $categoria->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_asignatura_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button>
                <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Panel de administración cargado'); </script>
@stop
