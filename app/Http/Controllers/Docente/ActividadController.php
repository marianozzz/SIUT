<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActividadController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividades = Actividad::where('user_id', auth()->id())->latest()->get();

        return view('docentes.actividades.index', compact('actividades'));
    }


    public function create()
    {
        $docenteId = auth()->user()->docente->id; // ajustalo si el user tiene directamente ID docente

        $cursos = Curso::whereHas('asignaturaCursos', function ($q) use ($docenteId) {
            $q->where('profesor_id', $docenteId);
        })->get();

        return view('docentes.actividades.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'contenido' => 'required|string',
            'cursos' => 'nullable|array',
            'cursos.*' => 'exists:cursos,id',
        ]);

        $actividad = Actividad::create([
            'user_id' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion, // nuevo campo
            'contenido' => $request->contenido,
            'asignada' => !empty($request->cursos),
        ]);

        if (!empty($request->cursos)) {
            $actividad->cursos()->sync($request->cursos);
        }

        return redirect()->route('docentes.actividades.index')
            ->with('success', 'Actividad creada correctamente.');
    }


 public function show($id)
    {
        // Cargar usuario y relación docente (si aplica)
        $user = Auth::user()->loadMissing('docente');

        // Buscar actividad por id
        $actividad = Actividad::with('cursos')->findOrFail($id);

        // Autorizar acceso: la policy debe validar que el usuario sea dueño (user_id)
        $this->authorize('view', $actividad);

        // Retornar vista con la actividad
        return view('docentes.actividades.show', compact('actividad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = Auth::user()->loadMissing('docente');

        $actividad = Actividad::with('cursos')->findOrFail($id);

        $this->authorize('update', $actividad);

        // Obtener cursos del docente para mostrar en el select
        $docenteId = $user->docente?->id;

        $cursos = Curso::whereHas('asignaturaCursos', function ($q) use ($docenteId) {
            $q->where('profesor_id', $docenteId);
        })->get();

        return view('docentes.actividades.edit', compact('actividad', 'cursos'));
    }

    public function update(Request $request, $id)
    {
        $actividad = Actividad::findOrFail($id);

        $this->authorize('update', $actividad);

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'contenido' => 'required|string',
            'cursos' => 'nullable|array',
            'cursos.*' => 'exists:cursos,id',
        ]);

        $actividad->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion, // nuevo campo
            'contenido' => $request->contenido,
            'asignada' => !empty($request->cursos),
        ]);

        if (!empty($request->cursos)) {
            $actividad->cursos()->sync($request->cursos);
        } else {
            $actividad->cursos()->detach();
        }

        return redirect()->route('docentes.actividades.index')
            ->with('success', 'Actividad actualizada correctamente.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
