@extends('adminlte::page')

@section('title', 'Nueva Especialidad')

@section('content_header')
    <h1>Nueva Especialidad</h1>
@stop

@section('content')
    <form action="{{ route('admin.especialidades.store') }}" method="POST">
        @csrf
        @include('admin.especialidades.partials.form')
    </form>
@stop
