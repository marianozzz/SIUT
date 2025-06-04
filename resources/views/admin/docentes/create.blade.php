@extends('adminlte::page')

@section('title', 'Alta de Docente')

@section('content_header')
    <h1>Alta de Docente</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('admin.docentes.store') }}" method="POST">
            @csrf

            {{-- DATOS DEL USUARIO --}}
            <h5 class="mb-3">Datos de Usuario Asociado</h5>

            <div class="form-group">
                <label for="email">Correo Electrónico (Usuario)</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="name">Nombre de Usuario</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña (solo si el usuario no existe)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <hr>

            {{-- DATOS DEL DOCENTE --}}
            <h5 class="mb-3">Datos del Docente</h5>

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
            </div>

            <div class="form-group">
                <label for="apellido">Apellido</label>
                <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
            </div>

            <div class="form-group">
                <label for="dni">DNI</label>
                <input type="text" name="dni" class="form-control" value="{{ old('dni') }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ route('admin.docentes.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</div>
@stop
