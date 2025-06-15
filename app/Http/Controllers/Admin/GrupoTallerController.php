<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GrupoTaller;
use App\Models\Curso;
use Illuminate\Http\Request;
use App\Models\AsignaturaCurso;


class GrupoTallerController extends Controller
{
public function index()
{
    $grupos = GrupoTaller::with([
        'asignaturaCurso.curso.division',
        'asignaturaCurso.asignatura'
    ])->get();


    return view('admin.grupos_talleres.index', compact('grupos'));
}


    // Mostrar formulario para crear grupo
    public function create()
    {
        $cursos = Curso::with('division')->get();
        $asignaturasCursos = AsignaturaCurso::with('asignatura', 'curso.division')->get();

        return view('admin.grupos_talleres.create', compact('cursos', 'asignaturasCursos'));
    }



public function store(Request $request)
{
    
    $request->validate([
        'nombre' => 'required|string|max:10',
        'asignatura_curso_id' => 'required|exists:asignatura_cursos,id',
        'alumnos' => 'nullable|array',
        'alumnos.*' => 'exists:alumnos,id',
    ]);

    $grupo = GrupoTaller::create([
        'nombre' => $request->nombre,
        'asignatura_curso_id' => $request->asignatura_curso_id,
    ]);

    if ($request->filled('alumnos')) {
        $grupo->alumnos()->sync($request->alumnos);
    }

    return redirect()->route('admin.grupos.index')->with('success', 'Grupo creado correctamente.');
}


        // Mostrar formulario para editar grupo
    public function edit(GrupoTaller $grupo)
{
   
    $asignaturasCursos = AsignaturaCurso::with('curso.division', 'asignatura')->get();

    // Obtener alumnos del curso correspondiente (si asignaturaCurso existe)
    $alumnosCurso = $grupo->asignaturaCurso
        ? $grupo->asignaturaCurso->curso->alumnos()->get()
        : collect();

    // IDs de alumnos asignados actualmente
    $alumnosGrupo = $grupo->alumnos()->pluck('alumno_id')->toArray();

    return view('admin.grupos_talleres.edit', compact('grupo', 'asignaturasCursos', 'alumnosCurso', 'alumnosGrupo'));
}



public function update(Request $request, GrupoTaller $grupo)
{
    $request->validate([
        'nombre' => 'required|string|max:10',
        'asignatura_curso_id' => 'required|exists:asignatura_cursos,id',
        'alumnos' => 'nullable|array',
        'alumnos.*' => 'exists:alumnos,id',
    ]);

    // Actualiza el nombre y el vínculo a la asignatura_curso
    $grupo->update([
        'nombre' => $request->nombre,
        'asignatura_curso_id' => $request->asignatura_curso_id,
    ]);

    // Sincroniza alumnos
    $grupo->alumnos()->sync($request->alumnos ?? []);

    return redirect()->route('admin.grupos.index')->with('success', 'Grupo actualizado correctamente.');
}


    // Eliminar grupo
    public function destroy(GrupoTaller $grupo)
    {
        $grupo->alumnos()->detach(); // eliminar relaciones pivot
        $grupo->delete();

        return redirect()->route('admin.grupos.index')->with('success', 'Grupo eliminado correctamente.');
    }

    public function alumnosDelCurso(Curso $curso)
    {
        $alumnos = $curso->alumnos()
            ->select('alumnos.id', 'alumnos.nombre', 'alumnos.apellido')
            ->get()
            ->map(function ($alumno) {
                $alumno->nombre_completo = $alumno->nombre . ' ' . $alumno->apellido;
                return $alumno;
            });
        return response()->json($alumnos);
    }


}
