@extends('adminlte::page')

@section('title', 'Panel de Administración')

@section('content_header')
    <h1>Dashboard de Administración</h1>
@stop

@section('content')
<div class="row">
    <!-- Tarjetas -->
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $totalEstudiantes }}" text="Estudiantes" icon="fas fa-user-graduate" theme="info"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $totalProfesores }}" text="Profesores" icon="fas fa-chalkboard-teacher" theme="success"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="{{ $totalCursos }}" text="Cursos" icon="fas fa-book-open" theme="warning"/>
    </div>
    <div class="col-lg-3 col-6">
        <x-adminlte-small-box title="0" text="Solicitudes Pendientes" icon="fas fa-envelope" theme="danger"/>
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

<!-- Tabla de solicitudes (sin datos reales por ahora) -->
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
                    <td colspan="5" class="text-center text-muted">
                        Sin datos por el momento.
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

    @php
        $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $labelsMatriculas = [];
        $datosMatriculas = [];

        foreach (range(1, 12) as $mes) {
            $labelsMatriculas[] = $meses[$mes - 1];
            $datosMatriculas[] = $matriculasPorMes[$mes] ?? 0;
        }

        $grados = $distribucionPorGrado->keys()->map(fn($nivel) => $nivel . 'º');
        $totales = $distribucionPorGrado->values();
    @endphp

    <script>
        // Gráfico de Matrículas
        new Chart(document.getElementById('matriculasChart'), {
            type: 'line',
            data: {
                labels: @json($labelsMatriculas),
                datasets: [{
                    label: 'Matrículas',
                    data: @json($datosMatriculas),
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Gráfico de Distribución por Grado
        new Chart(document.getElementById('distribucionChart'), {
            type: 'doughnut',
            data: {
                labels: @json($grados),
                datasets: [{
                    data: @json($totales),
                    backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#17a2b8']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
@stop
