<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $usuario = Auth::user();
        $docente = $usuario->docente;

        $asignaturasCursos = $docente->asignaturaCursos()
            ->with(['asignatura', 'curso.division'])
            ->get();

        return view('docentes.cursos.index', compact('asignaturasCursos'));
    }

    public function show($id)
    {
        $usuario = Auth::user();
        $docente = $usuario->docente;

        // Trae asignaturas del docente, división y alumnos del curso
        $curso = Curso::with([
            'asignaturas' => function ($query) use ($docente) {
                $query->where('profesor_id', $docente->id);
            },
            'division',
            'alumnos' // 👉 Agregado: lista de alumnos
        ])
        ->whereHas('asignaturas', function ($query) use ($docente) {
            $query->where('profesor_id', $docente->id);
        })
        ->findOrFail($id);

        return view('docentes.cursos.show', compact('curso'));
    }
}
