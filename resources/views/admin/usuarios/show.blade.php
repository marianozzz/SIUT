@extends('adminlte::page')

@section('title', 'Detalle de Usuario')

@section('content_header')
    <h1>Detalle del Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn btn-warning">✏️ Editar</a>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">🔙 Volver</a>
        </div>

        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">ID:</dt>
                <dd class="col-sm-9">{{ $usuario->id }}</dd>

                <dt class="col-sm-3">Nombre:</dt>
                <dd class="col-sm-9">{{ $usuario->name }}</dd>

                <dt class="col-sm-3">Correo Electrónico:</dt>
                <dd class="col-sm-9">{{ $usuario->email }}</dd>

                <dt class="col-sm-3">Roles:</dt>
                <dd class="col-sm-9">
                    @foreach ($usuario->getRoleNames() as $rol)
                        <span class="badge badge-primary">{{ $rol }}</span>
                    @endforeach
                </dd>
            </dl>
        </div>
    </div>
@stop
