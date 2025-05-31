<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $docente = auth()->user();

        // Suponiendo que tenés una relación como: $user->cursos()
       // $cursos = $docente->cursos; // O una consulta personalizada

        return view('docentes.dashboard');
    }
}
