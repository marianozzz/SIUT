@extends('adminlte::page')

@section('title', 'Ciclos')

@section('content_header')
    <h1>Listado de Ciclos</h1>
@endsection

@section('content')
    <a href="{{ route('admin.ciclos.create') }}" class="btn btn-success mb-3">Agregar Ciclo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ciclos as $ciclo)
                <tr>
                    <td>{{ $ciclo->nombre }}</td>
                    <td>{{ $ciclo->descripcion }}</td>
                    <td>
                        <a href="{{ route('admin.ciclos.edit', $ciclo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.ciclos.destroy', $ciclo->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este ciclo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
