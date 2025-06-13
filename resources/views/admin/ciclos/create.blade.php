@extends('adminlte::page')

@section('title', 'Agregar Ciclo')

@section('content_header')
    <h1>Agregar Ciclo</h1>
@endsection

@section('content')
    <form action="{{ route('admin.ciclos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('admin.ciclos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
