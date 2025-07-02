<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    /**
     * Mostrar formulario para tomar asistencia de la clase.
     */
    public function create(Curso $curso)
    {
        $alumnos = $curso->alumnos()->orderBy('apellido')->get();
        $fechaHoy = Carbon::now()->toDateString();

        return view('docentes.asistencias.create', compact('curso', 'alumnos', 'fechaHoy'));
    }

    /**
     * Guardar asistencia de la clase.
     */
    public function store(Request $request, Curso $curso)
    {
        $request->validate([
            'fecha' => 'required|date',
            'asistencias' => 'required|array',
            'asistencias.*' => 'boolean',
        ]);

        foreach ($request->asistencias as $alumno_id => $presente) {
            Asistencia::updateOrCreate(
                [
                    'alumno_id' => $alumno_id,
                    'curso_id' => $curso->id,
                    'fecha' => $request->fecha,
                ],
                [
                    'presente' => $presente,
                ]
            );
        }

        return redirect()->route('docentes.cursos.show', $curso->id)
            ->with('success', 'Asistencia registrada correctamente.');
    }
}
