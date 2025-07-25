@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Panel del Docente</h1>

    <div class="row justify-content-center text-center">

        {{-- Mis Cursos --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('docentes.cursos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-journal-bookmark-fill display-4 text-primary"></i>
                        <h5 class="mt-3">Mis Cursos</h5>
                        <p class="text-muted">Ver los cursos que tengo asignados</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Planificaciones y Programas --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('docentes.planificaciones.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-journal-text display-4 text-warning"></i>
                        <h5 class="mt-3">Planificaciones</h5>
                        <p class="text-muted">Crear y editar planificaciones y sus programas</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Actividades --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('docentes.actividades.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-folder-plus display-4 text-info"></i>
                        <h5 class="mt-3">Mis Actividades</h5>
                        <p class="text-muted">Crear guías, resoluciones y materiales para mis cursos</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Perfil --}}
        <div class="col-md-4 mb-4">
            <a href="{{ route('docentes.perfil.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-person-circle display-4 text-success"></i>
                        <h5 class="mt-3">Perfil</h5>
                        <p class="text-muted">Modificar mis datos personales</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Calendario (placeholder futuro) --}}
        <div class="col-md-4 mb-4">
            <a href="#" class="text-decoration-none">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <i class="bi bi-calendar-event display-4 text-danger"></i>
                        <h5 class="mt-3">Calendario</h5>
                        <p class="text-muted">Ver mis horarios semanales</p>
                    </div>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
