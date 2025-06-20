<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asignatura;
use App\Models\Curso;
use App\Models\Docente;
use App\Models\CategoriaAsignatura;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    public function index()
    {
       $asignaturas = Asignatura::with('categoria')->get();
       return view('admin.asignaturas.index', compact('asignaturas'));
    }

    public function create()
    {
        $categorias = CategoriaAsignatura::all();
        return view('admin.asignaturas.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_asignatura_id' => 'nullable|exists:categorias_asignaturas,id',
        ]);

        Asignatura::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_asignatura_id' => $request->categoria_asignatura_id,
        ]);

        return redirect()->route('admin.asignaturas.index')->with('success', 'Asignatura creada correctamente.');
    }

    public function show(Asignatura $asignatura)
    {
        return view('admin.asignaturas.show', compact('asignatura'));
    }

    public function edit(Asignatura $asignatura)
    {
        $categorias = CategoriaAsignatura::all();
        return view('admin.asignaturas.edit', compact('asignatura', 'categorias'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_asignatura_id' => 'nullable|exists:categorias_asignaturas,id',
        ]);

        $asignatura->update($request->all());

        return redirect()->route('admin.asignaturas.show', $asignatura)->with('success', 'Asignatura actualizada correctamente.');
    }

    public function asignarDocente($cursoId, $asignaturaId)
    {
        $curso = Curso::findOrFail($cursoId);
        $asignatura = Asignatura::findOrFail($asignaturaId);
        $docentes = Docente::all();

        return view('admin.asignaturas.asignar-docente', compact('curso', 'asignatura', 'docentes'));
    }

    public function guardarDocente(Request $request, $cursoId, $asignaturaId)
    {
        $request->validate([
            'profesor_id' => 'required|exists:docentes,id',
        ]);

        $curso = Curso::findOrFail($cursoId);
        $curso->asignaturas()->updateExistingPivot($asignaturaId, [
            'profesor_id' => $request->profesor_id,
        ]);

        return redirect()->route('admin.cursos.show', $cursoId)->with('success', 'Docente asignado correctamente.');
    }

    public function destroy(Asignatura $asignatura)
    {
        $asignatura->delete();
        return redirect()->route('admin.asignaturas.index')->with('success', 'Asignatura eliminada.');
    }
}
