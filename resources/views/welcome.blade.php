<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 5% auto;
            background: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .form-control {
            border-radius: 6px;
        }

        .form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #1e40af;
            border-color: #1e40af;
        }

        .btn-primary:hover {
            background-color: #1c3aa9;
        }

        .logo {
            display: block;
            margin: 0 auto 1.5rem;
            max-height: 100px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        {{-- Logo (opcional) --}}
        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo">

        <h4 class="mb-4 text-center text-dark">Iniciar sesión</h4>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li class="small">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" class="form-control" required autofocus value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="form-check mb-3">
                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                <label for="remember" class="form-check-label">Recordarme</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>

        @if (Route::has('password.request'))
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}" class="small text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>
        @endif
    </div>

</body>
</html>
