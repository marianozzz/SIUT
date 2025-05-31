@extends('adminlte::page')

@section('title', 'Detalle de Especialidad')

@section('content_header')
    <h1>Detalle de Especialidad</h1>
@stop

@section('content')
    <p><strong>Nombre:</strong> {{ $especialidad->nombre }}</p>
    <p><strong>Descripción:</strong> {{ $especialidad->descripcion }}</p>

    <a href="{{ route('admin.especialidades.index') }}" class="btn btn-secondary">Volver</a>
@stop
