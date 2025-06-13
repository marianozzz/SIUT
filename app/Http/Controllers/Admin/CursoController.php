<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Ciclo;
use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Division;
use App\Models\Especialidad;
use App\Models\Docente; // o el modelo correcto si usás otro para docentes
use App\Models\Turno;
use App\Models\Horario;
use App\Models\AsignaturaCurso;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
       $cursos = Curso::with(['division', 'especialidad'])->get(); // si hay relación con división

      //  dd($cursos);
        return view('admin.cursos.index', compact('cursos'));
    }

   public function create()
{
    $divisiones = Division::all();
    $especialidades = Especialidad::all();
    $ciclos = Ciclo::all();

    return view('admin.cursos.create', compact('divisiones', 'especialidades', 'ciclos'));
}


  public function store(Request $request)
{
    // Validación base
    $validated = $request->validate([
        'nivel' => 'required|integer|min:1|max:7',
        'division_id' => 'required|exists:divisions,id',
        'ciclo_id' => 'required|exists:ciclos,id',
        'especialidad_id' => 'nullable|exists:especialidades,id',
    ]);

    // Verificación lógica: solo permitir especialidad si nivel es >= 4
    if ($validated['nivel'] < 4) {
        $validated['especialidad_id'] = null;
    }

    Curso::create($validated);

    return redirect()->route('admin.cursos.index')->with('success', 'Curso creado correctamente.');
}


    public function show(Curso $curso)
    {
        return view('admin.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        $divisiones = Division::all();
        $especialidades = Especialidad::all();
        $asignaturas = Asignatura::all();
        $turnos = Turno::all();

        return view('admin.cursos.edit', compact('curso', 'divisiones', 'especialidades', 'asignaturas', 'turnos'));
    }

public function asignarAsignatura(Request $request, $cursoId)
{
     if (!$request->isMethod('post')) {
        abort(405, 'Método no permitido');
    }
    $request->validate([
        'asignatura_id' => 'required|exists:asignaturas,id',
        'tema' => 'required|string',
        'turno_id' => 'required|exists:turnos,id',
        'dias' => 'nullable|array',
    ]);

    $curso = Curso::findOrFail($cursoId);
    $asignaturaId = $request->asignatura_id;

    $yaAsignada = $curso->asignaturaCursos()->where('asignatura_id', $asignaturaId)->exists();
    if ($yaAsignada) {
        return redirect()->back()->withErrors(['La asignatura ya está asignada a este curso.']);
    }

    // Crear relación AsignaturaCurso con turno
    $asigCurso = AsignaturaCurso::create([
        'curso_id' => $cursoId,
        'asignatura_id' => $asignaturaId,
        'tema' => $request->tema,
        'turno_id' => $request->turno_id,
    ]);

    // Crear horarios por día
    if ($request->has('dias')) {
        foreach ($request->dias as $dia => $valores) {
            if (isset($valores['activo']) && $valores['activo']) {
                // Validar horas
                if (!empty($valores['hora_entrada']) && !empty($valores['hora_salida'])) {
                    $asigCurso->horarios()->create([
                        'dia' => $dia,
                        'hora_entrada' => $valores['hora_entrada'],
                        'hora_salida' => $valores['hora_salida'],
                    ]);
                }
            }
        }
    }

    return redirect()->with('success', 'Asignatura asignada correctamente al curso.');
}

public function quitarAsignatura(Curso $curso, Asignatura $asignatura)
{
    $curso->asignaturas()->detach($asignatura->id);
    return back()->with('success', 'Asignatura quitada.');
}

    public function update(Request $request, Curso $curso)
    {
       
        $request->validate([
            'nivel' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
            'especialidad_id' => 'nullable|exists:especialidades,id',
        ]);

        $curso->update($request->only(['nivel', 'division_id', 'especialidad_id']));
        
        return redirect()->route('admin.cursos.index')->with('success', 'Curso actualizado correctamente.');
    }

    public function agregarHorario(Request $request, $cursoId, $asignaturaCursoId)
        {
           
            $request->validate([
                'dia' => 'required|string',
                'hora_entrada' => 'required',
                'hora_salida' => 'required',
            ]);
//dd($request);
            Horario::create([
                'asignatura_curso_id' => $asignaturaCursoId,
                'dia' => $request->dia,
                'hora_entrada' => $request->hora_entrada,
                'hora_salida' => $request->hora_salida,
            ]);

            return redirect()->back()->with('success', 'Horario agregado correctamente.');
        }

    public function formAsignarAlumnos(Curso $curso)
    {
        $alumnos = Alumno::orderBy('apellido')->get();
        return view('admin.cursos.asignar-alumnos', compact('curso', 'alumnos'));
    }

    public function guardarAlumnos(Request $request, Curso $curso)
    {
        $request->validate([
            'alumnos' => 'array',
            'alumnos.*' => 'exists:alumnos,id',
        ]);

        $curso->alumnos()->sync($request->alumnos);
        return redirect()->route('admin.cursos.index')->with('success', 'Alumnos asignados correctamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();
        return redirect()->route('admin.cursos.index')->with('success', 'Curso eliminado correctamente.');
    }


}
