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
                'categoria_asignatura_id' => 'nullable|exists:categorias_asignaturas,id',
            ]);

            Asignatura::create([
                'nombre' => $request->nombre,
                'categoria_asignatura_id' => $request->categoria_asignatura_id,
            ]);

            return redirect()->route('admin.asignaturas.index')->with('success', 'Asignatura creada correctamente.');
        }


    public function show(Asignatura $asignatura)
    {
       // dd($asignatura);
        return view('admin.asignaturas.show', compact('asignatura'));
    }

    public function edit(Asignatura $asignatura)
    {
        $niveles = Nivel::all();
        $categorias = CategoriaAsignatura::all();

        $nivelesAsignados = $asignatura->niveles->pluck('id')->toArray();
        return view('admin.asignaturas.edit', compact('asignatura', 'niveles', 'nivelesAsignados','categorias'));
    }

    public function update(Request $request, Asignatura $asignatura)
    {
        $request->validate([
            'nombre' => 'required|string',
            'niveles' => 'required|array',
            'temas' => 'required|array'
        ]);

        $asignatura->update(['nombre' => $request->nombre]);

        $asignatura->niveles()->detach();

        foreach ($request->niveles as $i => $nivel_id) {
            $asignatura->niveles()->attach($nivel_id, [
                'temas' => $request->temas[$i]
            ]);
        }

        return redirect()->route('admin.asignaturas.index')->with('success', 'Asignatura actualizada correctamente.');
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

        // Actualizar el registro en la tabla pivot
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
