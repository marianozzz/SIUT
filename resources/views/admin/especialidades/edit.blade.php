{{-- resources/views/admin/especialidades/edit.blade.php --}}
@extends('adminlte::page')

@section('title', 'Editar Especialidad')

@section('content_header')
    <h1>Editar Especialidad</h1>
@stop

@section('content')
    <form action="{{ route('admin.especialidades.update', $especialidad) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.especialidades.partials.form')
    </form>
@stop
