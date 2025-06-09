<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\AsignaturaCurso;
use App\Models\Horario;

class AsignaturaHorarioController extends Controller
{
    /**
     * Guarda un nuevo horario para una asignatura de un curso.
     */
public function store(Request $request)
{
    //dd($request);
    $request->validate([
        'asignatura_id' => 'required|exists:asignaturas,id',
        'turno_id' => 'required|exists:turnos,id',
        'tema' => 'required|string',
        'dias' => 'required|array',
        'curso_id' => 'required|exists:cursos,id', // Lo tenés que enviar oculto en el form
    ]);

    // Crear AsignaturaCurso
    $asignaturaCurso = AsignaturaCurso::create([
        'curso_id' => $request->curso_id,
        'asignatura_id' => $request->asignatura_id,
        'turno_id' => $request->turno_id,
        'tema' => $request->tema,
    ]);

    // Crear horarios asociados
    foreach ($request->dias as $dia => $datos) {
        if (isset($datos['activo']) && $datos['hora_entrada'] && $datos['hora_salida']) {
            $asignaturaCurso->horarios()->create([
                'dia' => $dia,
                'hora_entrada' => $datos['hora_entrada'],
                'hora_salida' => $datos['hora_salida'],
            ]);
        }
    }

    return back()->with('success', 'Asignatura y horarios asignados correctamente.');
}


    /**
     * Elimina un horario específico de una asignatura de un curso.
     */
    public function destroy($cursoId, $asignaturaCursoId, $horarioId)
    {
        $horario = Horario::where('id', $horarioId)
            ->where('asignatura_curso_id', $asignaturaCursoId)
            ->firstOrFail();

        $horario->delete();

        return redirect()->back()->with('success', 'Horario eliminado correctamente.');
    }
}

