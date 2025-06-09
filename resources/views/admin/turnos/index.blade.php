@extends('adminlte::page')

@section('title', 'Turnos')

@section('content_header')
    <h1>Listado de Turnos</h1>
    <a href="{{ route('admin.turnos.create') }}" class="btn btn-primary">Nuevo Turno</a>
@stop

@section('content')
    @if(session('success'))
        <x-adminlte-alert theme="success" title="Éxito">
            {{ session('success') }}
        </x-adminlte-alert>
    @endif

    @if($turnos->isEmpty())
        <p>No hay turnos creados.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($turnos as $turno)
                    <tr>
                        <td>{{ ucfirst($turno->nombre) }}</td>
                        <td>
                            <a href="{{ route('admin.turnos.edit', $turno) }}" class="btn btn-sm btn-warning">Editar</a>

                            <form action="{{ route('admin.turnos.destroy', $turno) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <x-adminlte-button class="btn-sm" theme="danger" icon="fas fa-trash" type="submit" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este turno?')" />
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@stop
