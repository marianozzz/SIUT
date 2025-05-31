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
        $alumnos = Alumno::all();
        return view('admin.alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('admin.alumnos.create', compact('cursos'));
    }

    public function store(Request $request)
    {
        $alumno = Alumno::create($request->only([
            'nombre', 'apellido', 'dni', 'fecha_nacimiento', 'email', 'telefono', 'domicilio'
        ]));

       // $alumno->cursos()->sync($request->cursos);
        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno creado correctamente.');
    }

    public function show(Alumno $alumno)
    {
        return view('admin.alumnos.show', compact('alumno'));
    }

    public function edit(Alumno $alumno)
    {
        $cursos = Curso::all();
        return view('admin.alumnos.edit', compact('alumno', 'cursos'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        $alumno->update($request->only([
            'nombre', 'apellido', 'dni', 'fecha_nacimiento', 'email', 'telefono', 'domicilio'
        ]));

        $alumno->cursos()->sync($request->cursos);
        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno actualizado.');
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return redirect()->route('admin.alumnos.index')->with('success', 'Alumno eliminado.');
    }
}
