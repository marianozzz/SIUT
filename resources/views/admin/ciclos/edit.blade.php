@extends('adminlte::page')

@section('title', 'Editar Ciclo')

@section('content_header')
    <h1>Editar Ciclo</h1>
@endsection

@section('content')
    <form action="{{ route('admin.ciclos.update', $ciclo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $ciclo->nombre }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control">{{ $ciclo->descripcion }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.ciclos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
