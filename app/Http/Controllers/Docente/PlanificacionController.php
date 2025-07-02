<?php
namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Planificacion;
use App\Models\Curso;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlanificacionController extends Controller
{
        use AuthorizesRequests;
    public function index()
    {
        $docente = Auth::user()->load('docente')->docente;

        $planificaciones = Planificacion::where('docente_id', $docente->id)
            ->with(['curso.division', 'asignatura'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('docentes.planificaciones.index', compact('planificaciones'));
    }

    public function create()
    {
        $docente = Auth::user()->load('docente')->docente;

        $asignaturas = $docente->asignaturas;
        $cursos = $docente->cursos()->with('division')->get();

        return view('docentes.planificaciones.create', compact('asignaturas', 'cursos'));
    }

    public function store(Request $request)
    {
        $docente = Auth::user()->load('docente')->docente;

        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'curso_id' => 'required|exists:cursos,id',
            'fecha' => 'required|digits:4|integer|min:2000',
            'contenido' => 'nullable|string',
        ]);

        Planificacion::create([
            'docente_id' => $docente->id,
            'asignatura_id' => $request->asignatura_id,
            'curso_id' => $request->curso_id,
            'fecha' => $request->fecha,
            'contenido' => $request->contenido,
        ]);

        return redirect()->route('docentes.planificaciones.index')->with('success', 'Planificación registrada correctamente.');
    }

public function show($id)
{
    $user = Auth::user()->loadMissing('docente');

    $planificacion = Planificacion::with('programas')->findOrFail($id);

 /* codigo para debbuger
   logger([
        'user_id' => $user->id,
        'docente_id' => $user->docente?->id,
        'planificacion_docente_id' => $planificacion->docente_id,
    ]);
*/

    $this->authorize('view', $planificacion);

    return view('docentes.planificaciones.show', compact('planificacion'));
}


 public function edit($id)
{
    $user = Auth::user()->loadMissing('docente');
    $planificacion = Planificacion::with('asignatura', 'curso.division')->findOrFail($id);

    $this->authorize('update', $planificacion);

    $docente = $user->docente;
    $asignaturas = $docente->asignaturas;
    $cursos = $docente->cursos()->with('division')->get();

    return view('docentes.planificaciones.edit', compact('planificacion', 'asignaturas', 'cursos'));
}


public function update(Request $request, $id)
{
    $user = Auth::user()->loadMissing('docente');
    $planificacion = Planificacion::findOrFail($id);

    $this->authorize('update', $planificacion);

    $validated = $request->validate([
        'asignatura_id' => 'required|exists:asignaturas,id',
        'curso_id' => 'required|exists:cursos,id',
        'fecha' => 'required|digits:4|integer|min:2000|max:2099',
        'contenido' => 'required|string',
    ]);

    $planificacion->update($validated);

    return redirect()
        ->route('docentes.planificaciones.index')
        ->with('success', 'Planificación actualizada correctamente.');
}


    public function destroy(Planificacion $planificacion)
    {
        Auth::user()->load('docente');
        $this->authorize('delete', $planificacion);

        $planificacion->delete();

        return redirect()->route('docentes.planificaciones.index')->with('success', 'Planificación eliminada.');
    }
}
