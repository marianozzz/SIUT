<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('welcome'); // Usa tu vista Blade personalizada
    }

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        // Redirección basada en roles Spatie
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('docente')) {
            return redirect()->route('docentes.dashboard');
        } elseif ($user->hasRole('alumno')) {
            return redirect()->route('alumnos.dashboard');
        }

        // Redirección por defecto si no tiene ningún rol
        return redirect('/');
    }

    return back()->withErrors([
        'email' => 'Las credenciales no son válidas.',
    ])->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
