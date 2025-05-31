@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Atención!</strong> Revisa los errores del formulario.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $usuario->name) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                </div>

                <div class="form-group">
                    <label for="password">Nueva contraseña (opcional):</label>
                    <input type="password" name="password" class="form-control" placeholder="Solo si desea cambiarla">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmar nueva contraseña:</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Repetir nueva contraseña">
                </div>

                <div class="form-group">
                    <label for="roles">Rol asignado:</label>
                    <select name="roles[]" class="form-control" multiple required>
                        @foreach ($roles as $rol)
                            <option value="{{ $rol }}"
                                @if(in_array($rol, $usuario->getRoleNames()->toArray())) selected @endif>
                                {{ $rol }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@stop
