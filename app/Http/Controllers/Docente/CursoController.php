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
            ->with(['asignatura', 'curso.division', 'grupoTaller'])
            ->get();

        return view('docentes.cursos.index', compact('asignaturasCursos'));
    }

public function show($id)
{
    $usuario = Auth::user();
    $docente = $usuario->docente;

    $curso = Curso::with([
        'division',
        'alumnos.asistencias',    // para cálculo asistencia
        'alumnos.calificaciones', // para cálculo promedio
        'asignaturaCursos' => function ($query) use ($docente) {
            $query->where('profesor_id', $docente->id)
                  ->with(['grupoTaller', 'asignatura']);
        }
    ])
    ->whereHas('asignaturaCursos', function ($query) use ($docente) {
        $query->where('profesor_id', $docente->id);
    })
    ->findOrFail($id);

    return view('docentes.cursos.show', compact('curso'));
}

}
