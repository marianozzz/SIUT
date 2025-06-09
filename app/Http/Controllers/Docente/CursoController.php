<?php
namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;
use App\Models\Docente;

class CursoController extends Controller
{
        public function index()
        {
   $usuario = Auth::user();
    $docente = $usuario->docente;

    // Obtenemos asignaturas con curso y división (vía tabla intermedia)
    $asignaturasCursos = $docente->asignaturaCursos()
        ->with(['asignatura', 'curso.division'])
        ->get();

    return view('docentes.cursos.index', compact('asignaturasCursos'));
        }

    public function show($id)
    {
        $usuario = Auth::user();
        $docente = $usuario->docente;

        // Buscar el curso y asegurarse que el docente tenga asignaturas en él
        $curso = Curso::with(['asignaturas' => function ($query) use ($docente) {
                $query->where('profesor_id', $docente->id);
            }, 'division'])
            ->whereHas('asignaturas', function ($query) use ($docente) {
                $query->where('profesor_id', $docente->id);
            })
            ->findOrFail($id);

        return view('docentes.cursos.show', compact('curso'));
    }

}
