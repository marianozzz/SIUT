@extends('adminlte::page')

@section('title', 'Nuevo Turno')

@section('content_header')
    <h1>Crear Turno</h1>
@stop

@section('content')
    @if($errors->any())
        <x-adminlte-alert theme="danger" title="Errores encontrados">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </x-adminlte-alert>
    @endif

    <form method="POST" action="{{ route('admin.turnos.store') }}">
        @csrf

        <x-adminlte-input name="nombre" label="Nombre del turno" placeholder="Ej: Mañana" value="{{ old('nombre') }}" required />

        <x-adminlte-button label="Guardar" theme="primary" type="submit" class="mt-2" />
        <a href="{{ route('admin.turnos.index') }}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
@stop
