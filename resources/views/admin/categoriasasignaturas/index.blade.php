@extends('adminlte::page')

@section('title', 'Categorías de Asignaturas')

@section('content_header')
    <h1>Categorías de Asignaturas</h1>
@stop

@section('content')
<div class="container">
    <a href="{{ route('admin.categoriasasignaturas.create') }}" class="btn btn-primary mb-3">Agregar Categoría</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->nombre }}</td>
                    <td>
                        <a href="{{ route('admin.categoriasasignaturas.edit', $categoria) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.categoriasasignaturas.destroy', $categoria) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
