@extends('adminlte::page')

@section('title', 'Crear División')

@section('content_header')
    <h1>Crear nueva División</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.divisiones.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nombre">Nombre de la División</label>
            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('admin.divisiones.index') }}" class="btn btn-secondary">Volver</a>
    </form>
@stop

