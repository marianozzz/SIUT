@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Mis Cursos Asignados</h1>

    @if($cursos->isEmpty())
        <div class="alert alert-info text-center">
            No tenés cursos asignados actualmente.
        </div>
    @else
        <div class="row">
            @foreach($cursos as $curso)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $curso->nombre }}</h5>
                            <p class="card-text">
                                <strong>Año:</strong> {{ $curso->anio }}<br>
                                <strong>División:</strong> {{ $curso->division->nombre ?? 'Sin división' }}
                            </p>
                            <p><strong>Asignaturas asignadas:</strong></p>
                            <ul>
                                @foreach($curso->asignaturas as $asignatura)
                                    <li>{{ $asignatura->nombre }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
