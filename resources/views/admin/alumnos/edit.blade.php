@extends('adminlte::page')

@section('title', 'Nuevo Alumno')

@section('content_header')
    <h1>Agregar Alumno</h1>
@stop

@section('content')
    <form action="{{ route('admin.alumnos.store') }}" method="POST">
        @csrf
        @include('admin.alumnos.partials.form')
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
@stop
