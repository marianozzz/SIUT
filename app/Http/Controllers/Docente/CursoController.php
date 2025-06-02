<?php
namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $docente = Auth::user();

        $cursos = Curso::whereHas('asignaturas', function ($query) use ($docente) {
            $query->where('profesor_id', $docente->id);
        })->get();

        return view('docentes.cursos.index', compact('cursos'));
    }
}
