<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Calificacion;

class CalificacionController extends Controller
{
    /**
     * Mostrar formulario para cargar calificaciones de la clase.
     */
    public function create(Curso $curso)
    {
        $alumnos = $curso->alumnos()->orderBy('apellido')->get();
        $asignaturas = $curso->asignaturas()
            ->wherePivot('profesor_id', auth()->user()->docente->id)
            ->get();

        return view('docentes.calificaciones.create', compact('curso', 'alumnos', 'asignaturas'));
    }

    /**
     * Guardar calificaciones de la clase.
     */
    public function store(Request $request, Curso $curso)
    {
        $request->validate([
            'fecha' => 'required|date',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'notas' => 'required|array',
            'notas.*' => 'nullable|numeric|min:1|max:10',
            'descripcion' => 'nullable|string|max:255',
        ]);

        foreach ($request->notas as $alumno_id => $nota) {
            if ($nota !== null) {
                Calificacion::create([
                    'alumno_id' => $alumno_id,
                    'curso_id' => $curso->id,
                    'asignatura_id' => $request->asignatura_id,
                    'nota' => $nota,
                    'descripcion' => $request->descripcion,
                    'fecha' => $request->fecha,
                ]);
            }
        }

        return redirect()->route('docentes.cursos.show', $curso->id)
            ->with('success', 'Calificaciones guardadas correctamente.');
    }
}
