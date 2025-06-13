@extends('layouts.docentes')

@section('title', 'Calendario Docente')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Calendario de Días Hábiles</h1>
    <div id="calendar"></div>
</div>
@endsection

@section('css')
    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">
    <style>
        #calendar {
            max-width: 100%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
@endsection

@section('js')
    {{-- FullCalendar JS --}}
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                firstDay: 1,           // Lunes como primer día
                weekends: false,       // Oculta sábado y domingo
                locale: 'es',          // Idioma español
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: [] // Podés cargar eventos si lo deseás
            });

            calendar.render();
        });
    </script>
@endsection
