@extends('layouts.docentes')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4 text-center">Mi Perfil - Docente</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

            {{-- Agrega más campos si tenés más datos personalizados --}}

            <a href="{{ route('docente.perfil.edit', auth()->id()) }}" class="btn btn-primary mt-3">Editar Perfil</a>
        </div>
    </div>
</div>
@endsection
