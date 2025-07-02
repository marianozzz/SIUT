<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Programa;
use App\Models\Planificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProgramaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $docente = Auth::user()->loadMissing('docente');

        $programas = Programa::with('planificacion.curso.division', 'planificacion.asignatura')
            ->whereHas('planificacion', fn($q) => $q->where('docente_id', $docente->id))
            ->orderBy('cuatrimestre')
            ->get();

        return view('docentes.programas.index', compact('programas'));
    }

    public function create($planificacion_id)
    {
        $user = Auth::user()->loadMissing('docente');

        $planificacion = Planificacion::with('curso.division', 'asignatura')->findOrFail($planificacion_id);

        $this->authorize('update', $planificacion);

        return view('docentes.programas.create', compact('planificacion'));
    }

    public function store(Request $request, $planificacion_id)
    {
        $user = Auth::user()->loadMissing('docente');
        $planificacion = Planificacion::findOrFail($planificacion_id);

        $this->authorize('update', $planificacion);

        $request->validate([
            'cuatrimestre' => 'required|in:1,2',
            'unidad' => 'required|string|max:255',
            'eje_tematico' => 'required|string|max:255',
            'contenidos' => 'nullable|string',
        ]);

        Programa::create([
            'planificacion_id' => $planificacion->id,
            'cuatrimestre' => $request->cuatrimestre,
            'unidad' => $request->unidad,
            'eje_tematico' => $request->eje_tematico,
            'contenidos' => $request->contenidos,
        ]);

        return redirect()->route('docentes.planificaciones.show', $planificacion)
            ->with('success', 'Programa registrado.');
    }

    public function show(Programa $programa)
    {
        $programa->loadMissing('planificacion');
        Auth::user()->loadMissing('docente');

        $this->authorize('view', $programa);

        return view('docentes.programas.show', compact('programa'));
    }

    public function edit(Programa $programa)
    {
        $programa->loadMissing('planificacion.curso.division', 'planificacion.asignatura');
        Auth::user()->loadMissing('docente');

        $this->authorize('update', $programa);

        $planificacion = $programa->planificacion;

        return view('docentes.programas.edit', compact('programa', 'planificacion'));
    }


    public function update(Request $request, Programa $programa)
    {
        $programa->loadMissing('planificacion');
        Auth::user()->loadMissing('docente');

        $this->authorize('update', $programa);

        $request->validate([
            'cuatrimestre' => 'required|in:1,2',
            'unidad' => 'required|string|max:255',
            'eje_tematico' => 'required|string|max:255',
            'contenidos' => 'nullable|string',
        ]);

        $programa->update($request->only(['cuatrimestre', 'unidad', 'eje_tematico', 'contenidos']));

        return redirect()->route('docentes.planificaciones.show', $programa->planificacion)
            ->with('success', 'Programa actualizado.');
    }

    public function destroy(Programa $programa)
    {
        $programa->loadMissing('planificacion');
        Auth::user()->loadMissing('docente');

        $this->authorize('delete', $programa);

        $planificacion = $programa->planificacion;
        $programa->delete();

        return redirect()->route('docentes.planificaciones.show', $planificacion)
            ->with('success', 'Programa eliminado.');
    }
}
