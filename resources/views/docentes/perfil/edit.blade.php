@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Editar Perfil - Docente</h1>

    <form action="{{ route('docente.perfil.update', auth()->id()) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}">
        </div>

        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="{{ route('docente.perfil.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
