@extends('adminlte::page')

@section('title', 'Detalle de Solicitud')

@section('content_header')
    <h1>Detalle de Solicitud #{{ $solicitud->id }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">

            <dl class="row">
                <dt class="col-sm-3">Tipo de Solicitud</dt>
                <dd class="col-sm-9">{{ $solicitud->tipo->nombre }}</dd>

                <dt class="col-sm-3">Alumno</dt>
                <dd class="col-sm-9">
                    {{ $solicitud->alumno?->apellido }}, {{ $solicitud->alumno?->nombre ?? 'No especificado' }}
                </dd>

                <dt class="col-sm-3">Docente</dt>
                <dd class="col-sm-9">
                    {{ $solicitud->docente?->user->name ?? 'No especificado' }}
                </dd>

                <dt class="col-sm-3">Motivo</dt>
                <dd class="col-sm-9">{{ $solicitud->motivo }}</dd>

                <dt class="col-sm-3">Estado</dt>
                <dd class="col-sm-9">
                    <span class="badge bg-{{ $solicitud->estado === 'pendiente' ? 'warning' : ($solicitud->estado === 'aprobada' ? 'success' : 'danger') }}">
                        {{ ucfirst($solicitud->estado) }}
                    </span>
                </dd>

                @if($solicitud->respuesta)
                    <dt class="col-sm-3">Respuesta</dt>
                    <dd class="col-sm-9">{{ $solicitud->respuesta }}</dd>
                @endif

                @if($solicitud->archivo)
                    <dt class="col-sm-3">Archivo Adjunto</dt>
                    <dd class="col-sm-9">
                        <a href="{{ Storage::url($solicitud->archivo) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                            Ver Archivo
                        </a>
                    </dd>
                @endif
            </dl>

            <a href="{{ route('admin.solicitudes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>
@stop
