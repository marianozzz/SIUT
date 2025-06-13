<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Curso;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::with('cursos.division')->orderBy('apellido')->get();

        return view('admin.alumnos.index', compact('alumnos'));
    }


        public function create()
    {
        $cursos = Curso::with('division')->get();
        return view('admin.alumnos.create', compact('cursos'));
    }

    // AlumnoController.php
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:alumnos,dni',
            'fecha_nacimiento' => 'nullable|date',
            'sexo' => 'nullable|string|max:10',
            'nacionalidad' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255|unique:alumnos,email',
            'telefono' => 'nullable|string|max:20',
            'domicilio' => 'nullable|string|max:255',
        ]);

        $alumno = Alumno::create($request->all());

        return redirect()->route('admin.alumnos.create', $alumno);
    }

    public function show(Alumno $alumno)
    {
        return view('admin.alumnos.show', compact('alumno'));
    }


    public function edit(Alumno $alumno)
    {
        $cursos = Curso::with('division')->get();

        return view('admin.alumnos.edit', compact('alumno', 'cursos'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni' => 'required|string|max:15|unique:alumnos,dni,' . $alumno->id,
            'fecha_nacimiento' => 'nullable|date',
            'email' => 'nullable|email|max:255|unique:alumnos,email,' . $alumno->id,
            'telefono' => 'nullable|string|max:20',
            'domicilio' => 'nullable|string|max:255',
            'cursos' => 'nullable|array',
            'cursos.*' => 'exists:cursos,id',
        ]);

        $alumno->update($request->only([
            'nombre',
            'apellido',
            'dni',
            'fecha_nacimiento',
            'email',
            'telefono',
            'domicilio',
        ]));

        // Sincroniza los cursos con la tabla pivot
        $alumno->cursos()->sync($request->input('cursos', []));

        return redirect()->route('admin.alumnos.index')
            ->with('success', 'Alumno actualizado correctamente.');
    }

    public function asignarCurso(Alumno $alumno)
{
    $cursos = Curso::with('division')->get();
    return view('admin.alumnos.asignar-curso', compact('alumno', 'cursos'));
}

public function guardarCurso(Request $request, Alumno $alumno)
{
    $request->validate([
        'curso_id' => 'required|exists:cursos,id',
    ]);

    $alumno->cursos()->sync([$request->curso_id]); // o attach si permitís múltiples

    return redirect()->route('admin.alumnos.index')->with('success', 'Curso asignado al alumno.');
}

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno eliminado.');
    }
}
