<?php

// app/Http/Controllers/Admin/PlanificacionController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Planificacion;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Docente;
use Illuminate\Http\Request;

class PlanificacionController extends Controller
{
    public function index()
    {
        $planificaciones = Planificacion::with(['asignatura', 'curso', 'docente'])->get();
        return view('admin.planificaciones.index', compact('planificaciones'));
    }

    public function create()
    {
        return view('admin.planificaciones.create', [
            'asignaturas' => Asignatura::all(),
            'cursos' => Curso::all(),
            'docentes' => Docente::all()
        ]);
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'curso_id' => 'required|exists:cursos,id',
            'docente_id' => 'nullable|exists:docentes,id',
            'fecha' => 'required|integer',
            'contenido' => 'nullable|string',
        ]);

        Planificacion::create($request->all());

        return redirect()->route('admin.planificaciones.index')->with('success', 'Planificación guardada correctamente.');
    }

    public function show(Planificacion $planificacion)
    {
        return view('admin.planificaciones.show', compact('planificacion'));
    }

    public function edit(Planificacion $planificacion)
    {
        return view('admin.planificaciones.edit', [
            'planificacion' => $planificacion,
            'asignaturas' => Asignatura::all(),
            'cursos' => Curso::all(),
            'docentes' => Docente::all()
        ]);
    }

    public function update(Request $request, Planificacion $planificacion)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'curso_id' => 'required|exists:cursos,id',
            'docente_id' => 'required|exists:docentes,id',
            'anio' => 'required|integer',
            'contenido' => 'nullable|string',
        ]);

        $planificacion->update($request->all());

        return redirect()->route('admin.planificaciones.index')->with('success', 'Planificación actualizada.');
    }

    public function destroy(Planificacion $planificacion)
    {
        $planificacion->delete();
        return redirect()->route('admin.planificaciones.index')->with('success', 'Planificación eliminada.');
    }
}
