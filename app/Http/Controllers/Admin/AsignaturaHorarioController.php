<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;
use App\Models\AsignaturaCurso;
use App\Models\Horario;
use App\Models\Docente;


class AsignaturaHorarioController extends Controller
{
    

    public function vistaAsignarDocentePorDia($asignaturaCursoId)
    {
        $asignaturaCurso = AsignaturaCurso::with(['asignatura', 'curso', 'horarios'])->findOrFail($asignaturaCursoId);
        $docentes = Docente::all();

        return view('admin.horarios.asignar-docente-por-dia', compact('asignaturaCurso', 'docentes'));
    }

    public function asignarDocentePorDia(Request $request)
    {
        $request->validate([
            'asignatura_curso_id' => 'required|exists:asignatura_cursos,id',
            'dia' => 'required|string',
            'profesor_id' => 'required|exists:docentes,id',
        ]);

        $horario = Horario::where('asignatura_curso_id', $request->asignatura_curso_id)
            ->where('dia', $request->dia)
            ->firstOrFail();

        $horario->profesor_id = $request->profesor_id;
        $horario->save();

        return redirect()->back()->with('success', 'Docente asignado correctamente al día ' . ucfirst($request->dia));
    }

    public function store(Request $request)
    {
        $request->validate([
            'asignatura_id' => 'required|exists:asignaturas,id',
            'turno_id' => 'required|exists:turnos,id',
            'tema' => 'required|string',
            'dias' => 'required|array',
            'curso_id' => 'required|exists:cursos,id',
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
