@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard de Administración</h1>
@stop

@section('content')
<div class="container">
    <h1>Listado de Materias</h1>
    <a href="{{ route('admin.asignaturas.create') }}" class="btn btn-primary mb-3">Agregar Materia</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Tipo</th> <!-- Categoría de asignatura -->
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaturas as $materia)
                <tr>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->nivel }}</td>
                    <td>{{ $materia->categoria->nombre ?? 'Sin asignar' }}</td>
                    <td>
                        <a href="{{ route('admin.asignaturas.show', $materia) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.asignaturas.edit', $materia) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.asignaturas.destroy', $materia) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar materia?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Panel de administración cargado'); </script>
@stop
