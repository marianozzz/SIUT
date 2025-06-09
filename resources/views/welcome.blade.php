<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Escolar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(135deg, #007bff, #6610f2);
            color: white;
            padding: 5rem 1rem;
            text-align: center;
        }
        .features {
            padding: 4rem 1rem;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #6610f2;
        }
        footer {
            background: #343a40;
            color: white;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>

    {{-- Hero / Encabezado --}}
    <section class="hero">
        <div class="container">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Escuela" class="mb-4" style="max-height: 100px;">
            <h1 class="display-4">Sistema de Gestión Escolar</h1>
            <p class="lead">Una plataforma para administrar fácilmente cursos, asignaturas, docentes y horarios.</p>

            <div class="mt-4">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg me-2">
                    <i class="fas fa-sign-in-alt"></i> Iniciar sesión
                </a>

                @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-user-plus"></i> Registrarse
                    </a>
                @endif
            </div>
        </div>
    </section>

    {{-- Sección de funcionalidades --}}
    <section class="features">
        <div class="container text-center">
            <h2 class="mb-5">¿Qué podés hacer con el sistema?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <i class="fas fa-users feature-icon mb-3"></i>
                    <h5>Gestionar Cursos y Divisiones</h5>
                    <p>Creá y editá cursos, asigná divisiones y organizá niveles académicos.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-book feature-icon mb-3"></i>
                    <h5>Asignar Asignaturas</h5>
                    <p>Conectá asignaturas con cursos, definí temas específicos y asigná docentes.</p>
                </div>
                <div class="col-md-4 mb-4">
                    <i class="fas fa-clock feature-icon mb-3"></i>
                    <h5>Controlar Horarios</h5>
                    <p>Definí los días y horarios para cada asignatura por curso de forma flexible.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Pie de página --}}
    <footer>
        &copy; {{ date('Y') }} Sistema Escolar - Desarrollado por tu equipo. Todos los derechos reservados.
    </footer>

</body>
</html>
