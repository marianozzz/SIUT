<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Laravel\SerializableClosure\Support\ReflectionClosure;
use Illuminate\Routing\Middleware as BaseMiddleware;
use Illuminate\Routing\Attributes\AsMiddleware;

#[AsMiddleware('redirect.by.role')]
class RedirectByRole
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('docentes')) {
            return redirect()->route('docentes.dashboard');
        }

        if ($user->hasRole('alumno')) {
            return redirect()->route('alumnos.dashboard');
        }

        return $next($request);
    }
}
