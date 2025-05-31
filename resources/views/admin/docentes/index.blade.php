@extends('adminlte::page')

@section('title', 'Listado de Docentes')

@section('content_header')
    <h1>Listado de Docentes</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('admin.docentes.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Nuevo Docente
        </a>
    </div>

    <div class="card-body">
        @if($docentes->count())
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre Completo</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($docentes as $docente)
                <tr>
                    <td>{{ $docente->id }}</td>
                    <td>{{ $docente->nombre }} {{ $docente->apellido }}</td>
                    <td>{{ $docente->dni }}</td>
                    <td>{{ $docente->telefono }}</td>
                    <td>{{ $docente->direccion }}</td>
                    <td>
                        <a href="{{ route('admin.docentes.show', $docente) }}" class="btn btn-info btn-sm">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.docentes.edit', $docente) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.docentes.destroy', $docente) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este docente?')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay docentes registrados.</p>
        @endif
    </div>
</div>
@stop
