@extends('adminlte::page')

@section('title', 'Divisiones')

@section('content_header')
    <h1>Listado de Divisiones</h1>
    <a href="{{ route('admin.divisiones.create') }}" class="btn btn-primary">Agregar División</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($divisiones->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($divisiones as $division)
                    <tr>
                        <td>{{ $division->id }}</td>
                        <td>{{ $division->nombre }}</td>
                        <td>
                            <a href="{{ route('admin.divisiones.edit', $division->id) }}" class="btn btn-sm btn-warning">Editar</a>
                            <form action="{{ route('admin.divisiones.destroy', $division->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta división?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <strong>No hay divisiones registradas.</strong>
    @endif
@stop
