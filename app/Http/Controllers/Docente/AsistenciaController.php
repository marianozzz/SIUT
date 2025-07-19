<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\Asistencia;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    // app/Http/Controllers/Docente/AsistenciaController.php
public function index(Curso $curso)
{
    /** 
     * ➊ Traemos todos los alumnos del curso y, dentro de cada uno,
     *    solo sus asistencias pertenecientes a este curso,
     *    ordenadas por fecha.
     */
    $alumnos = $curso->alumnos()
        ->with(['asistencias' => function ($q) use ($curso) {
            $q->where('curso_id', $curso->id)->orderBy('fecha');
        }])
        ->orderBy('apellido')
        ->orderBy('nombre')
        ->get();

    /**
     * ➋ Construimos la colección de fechas únicas donde hubo asistencia,
     *    para generar las columnas de la tabla.
     */
    $fechas = $alumnos
        ->flatMap(fn ($a) => $a->asistencias->pluck('fecha'))
        ->unique()
        ->sort()
        ->values();   // colección ordenada de fechas

    return view('docentes.asistencias.index', compact('curso', 'alumnos', 'fechas'));
}

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

    public function show(Curso $curso)
{
    $alumnos = $curso->alumnos()->orderBy('apellido')->get();

    // Traer todas las asistencias del curso agrupadas por fecha
    $asistenciasPorFecha = Asistencia::where('curso_id', $curso->id)
        ->orderBy('fecha')
        ->get()
        ->groupBy('fecha');

    return view('docentes.asistencias.show', compact('curso', 'alumnos', 'asistenciasPorFecha'));
}

}
