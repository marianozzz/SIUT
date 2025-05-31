<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Alumno;
use App\Models\Asignatura;
use App\Models\Division;
use App\Models\Especialidad;
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
        $divisiones = Division::all(); // si usas divisiones
        return view('admin.cursos.create', compact('divisiones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nivel' => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id'
        ]);

        Curso::create($request->all());

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

        return view('admin.cursos.edit', compact('curso', 'divisiones', 'especialidades', 'asignaturas'));
    }


public function asignarAsignatura(Request $request, Curso $curso)
{
    $request->validate([
        'asignatura_id' => 'required|exists:asignaturas,id',
        'tema' => 'required|string',
    ]);

    $curso->asignaturas()->syncWithoutDetaching([
        $request->asignatura_id => ['tema' => $request->tema]
    ]);

    return back()->with('success', 'Asignatura asignada con éxito.');
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
