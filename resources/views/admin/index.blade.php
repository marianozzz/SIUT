@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard de Administración</h1>
@stop

@section('content')
<div class="row">
    <!-- Tarjetas -->
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="1250" text="Estudiantes" icon="fas fa-user-graduate" theme="info"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="85" text="Profesores" icon="fas fa-chalkboard-teacher" theme="success"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="120" text="Cursos" icon="fas fa-book-open" theme="warning"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="14" text="Solicitudes Pendientes" icon="fas fa-envelope" theme="danger"/>
    </div>
</div>

<div class="row">
    <!-- Gráfico de matrículas -->
    <div class="col-md-6">
        <x-adminlte-card title="Matrículas por Mes" theme="primary" collapsible>
            <canvas id="matriculasChart" style="height:200px;"></canvas>
        </x-adminlte-card>
    </div>

    <!-- Gráfico de distribución -->
    <div class="col-md-6">
        <x-adminlte-card title="Distribución por Grado" theme="indigo" collapsible>
            <canvas id="distribucionChart" style="height:200px;"></canvas>
        </x-adminlte-card>
    </div>
</div>

<!-- Tabla de solicitudes -->
<x-adminlte-card title="Solicitudes Recientes" theme="lightblue" icon="fas fa-tasks" collapsible>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Estudiante</th>
                    <th>Curso</th>
                    <th>Solicitud</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ana López</td>
                    <td>5to A</td>
                    <td>Cambio curso</td>
                    <td><span class="badge badge-warning">Pendiente</span></td>
                    <td>
                        <button class="btn btn-success btn-sm">Aceptar</button>
                        <button class="btn btn-danger btn-sm">Rechazar</button>
                    </td>
                </tr>
                <tr>
                    <td>Carlos Ruiz</td>
                    <td>6to B</td>
                    <td>Baja temporal</td>
                    <td><span class="badge badge-info">En revisión</span></td>
                    <td>
                        <button class="btn btn-success btn-sm">Aceptar</button>
                        <button class="btn btn-danger btn-sm">Rechazar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gráfico de líneas: Matrículas
        new Chart(document.getElementById('matriculasChart'), {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun'],
                datasets: [{
                    label: 'Matrículas',
                    data: [50, 75, 120, 200, 180, 250],
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            }
        });

        // Gráfico circular: Distribución
        new Chart(document.getElementById('distribucionChart'), {
            type: 'doughnut',
            data: {
                labels: ['1ro', '2do', '3ro', '4to', '5to', '6to'],
                datasets: [{
                    data: [120, 150, 200, 180, 160, 140],
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8']
                }]
            }
        });

        console.log('Panel de administración cargado');
    </script>
@stop
