<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignaturaCurso;
use App\Models\Curso;
use App\Models\Asignatura;
use App\Models\Docente;
use App\Models\Turno;
use App\Models\Horario;
use Illuminate\Http\Request;

class AsignaturaCursoController extends Controller
{

public function index(Request $request)
{
    $query = AsignaturaCurso::with(['curso.division', 'asignatura', 'profesor', 'turno', 'horarios']);

    if ($request->filled('curso_id')) {
        $query->where('curso_id', $request->curso_id);
    }

    if ($request->filled('asignatura_id')) {
        $query->where('asignatura_id', $request->asignatura_id);
    }

    if ($request->filled('profesor_id')) {
        $query->where('profesor_id', $request->profesor_id);
    }

    $asignaturaCursos = $query->paginate(15);

    // Para los selects del filtro
    $cursos = Curso::with('division')->get();
    $asignaturas = Asignatura::all();
    $docentes = Docente::all();

    return view('admin.asignatura-cursos.index', compact('asignaturaCursos', 'cursos', 'asignaturas', 'docentes'));
}


public function create()
{
    $cursos = Curso::with('division')->get(); // para mostrar nivel + división
    $asignaturas = Asignatura::all();
    $docentes = Docente::all();
    $turnos = Turno::all();

    return view('admin.asignatura-cursos.create', compact('cursos', 'asignaturas', 'docentes', 'turnos'));
}




public function store(Request $request)
{
    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
        'asignatura_id' => 'required|exists:asignaturas,id',
        'profesor_id' => 'nullable|exists:docentes,id',
        'tema' => 'nullable|string',
        'turno_id' => 'nullable|exists:turnos,id',
        'dias' => 'array',
    ]);

    // 1. Crear asignatura_curso
    $asignaturaCurso = AsignaturaCurso::create([
        'curso_id' => $request->curso_id,
        'asignatura_id' => $request->asignatura_id,
        'profesor_id' => $request->profesor_id,
        'tema' => $request->tema,
        'turno_id' => $request->turno_id,
    ]);

    // 2. Crear horarios solo para días activos
    if ($request->has('dias')) {
        foreach ($request->dias as $dia => $valores) {
            if (isset($valores['activo']) && $valores['activo'] === 'on') {
                Horario::create([
                    'asignatura_curso_id' => $asignaturaCurso->id,
                    'dia' => $dia,
                    'hora_entrada' => $valores['hora_entrada'],
                    'hora_salida' => $valores['hora_salida'],
                    'turno_id' => $request->turno_id,
                    'profesor_id' => $request->profesor_id,
                ]);
            }
        }
    }

    return redirect()->route('admin.asignatura-cursos.index')
        ->with('success', 'Asignación y horarios creados correctamente.');
}


    public function edit(AsignaturaCurso $asignaturaCurso)
    {
        $cursos = Curso::all();
        $asignaturas = Asignatura::all();
        $docentes = Docente::all();
        $turnos = Turno::all();

        return view('admin.asignatura-cursos.edit', compact('asignaturaCurso', 'cursos', 'asignaturas', 'docentes', 'turnos'));
    }



    public function update(Request $request, AsignaturaCurso $asignaturaCurso)
    {
        $request->validate([
            'curso_id' => 'required|exists:cursos,id',
            'asignatura_id' => 'required|exists:asignaturas,id',
            'profesor_id' => 'nullable|exists:docentes,id',
            'tema' => 'nullable|string',
            'turno_id' => 'nullable|exists:turnos,id',
        ]);

        $asignaturaCurso->update($request->only([
            'curso_id', 'asignatura_id', 'profesor_id', 'tema', 'turno_id',
        ]));

        // Procesar días
        $dias = $request->input('dias', []);
        $idsExistentes = [];

        foreach ($dias as $dia => $datos) {
            if (isset($datos['activo'])) {
                $horarioData = [
                    'asignatura_curso_id' => $asignaturaCurso->id,
                    'dia' => $dia,
                    'hora_entrada' => $datos['hora_entrada'],
                    'hora_salida' => $datos['hora_salida'],
                    'profesor_id' => $request->profesor_id,
                    'turno_id' => $request->turno_id,
                ];

                if (!empty($datos['id'])) {
                    // Actualiza
                    $horario = Horario::find($datos['id']);
                    if ($horario) {
                        $horario->update($horarioData);
                        $idsExistentes[] = $horario->id;
                    }
                } else {
                    // Crea
                    $nuevo = Horario::create($horarioData);
                    $idsExistentes[] = $nuevo->id;
                }
            }
        }

        // Elimina horarios desmarcados
        $asignaturaCurso->horarios()
            ->whereNotIn('id', $idsExistentes)
            ->delete();

        return redirect()->route('admin.asignatura-cursos.index')
            ->with('success', 'Asignación actualizada correctamente.');
    }


    public function destroy(AsignaturaCurso $asignaturaCurso)
    {
        $asignaturaCurso->delete();

        return redirect()->route('admin.asignatura-cursos.index')->with('success', 'Asignación eliminada.');
    }
}
