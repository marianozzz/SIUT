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

        $cursos = Curso::with('asignaturas')
            ->whereHas('asignaturas', function ($query) use ($docente) {
                $query->where('profesor_id', $docente->id);
            })->get();



        return view('docentes.cursos.index', compact('cursos'));
    }
}
