@extends('adminlte::page')

@section('title', 'Planificaciones')

@section('content_header')
    <h1>Planificaciones</h1>
    <a href="{{ route('admin.planificaciones.create') }}" class="btn btn-primary">Nueva Planificación</a>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Docente</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planificaciones as $plan)
                <tr>
                    <td>{{ $plan->asignatura->nombre }}</td>
                    <td>{{ $plan->curso->nivel }} {{ $plan->curso->division->nombre ?? '' }}</td>
                    <td>{{ $plan->docente->nombre_completo }}</td>
                    <td>{{ $plan->fecha }}</td>
                    <td>
                        <a href="{{ route('admin.planificaciones.show', $plan) }}" class="btn btn-info btn-sm">Ver</a>
                        <a href="{{ route('admin.planificaciones.edit', $plan) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('admin.planificaciones.destroy', $plan) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop
