@extends('adminlte::page')

@section('title', 'Detalle de Asignatura')

@section('content_header')
    <h1>Asignatura: {{ $asignatura->nombre }}</h1>
    <a href="{{ route('admin.asignaturas.index') }}" class="btn btn-secondary">Volver al listado</a>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5><strong>Descripción:</strong></h5>
            <p>{{ $asignatura->descripcion ?? 'Sin descripción' }}</p>

            <hr>

            <h5><strong>Categoría:</strong></h5>
            <p>{{ $asignatura->categoria ? $asignatura->categoria->nombre : 'Sin categoría' }}</p>
        </div>
    </div>
@stop

