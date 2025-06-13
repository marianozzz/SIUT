<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ciclo;
use Illuminate\Http\Request;

class CicloController extends Controller
{
    public function index()
    {
        $ciclos = Ciclo::all();
        return view('admin.ciclos.index', compact('ciclos'));
       // return view('admin.cursos.index', compact('cursos'));
    }

    public function create()
    {
        return view('admin.ciclos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:ciclos,nombre',
            'descripcion' => 'nullable',
        ]);

        Ciclo::create($request->all());
        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo creado correctamente.');
    }

    public function edit(Ciclo $ciclo)
    {
        return view('admin.ciclos.edit', compact('ciclo'));
    }

    public function update(Request $request, Ciclo $ciclo)
    {
        $request->validate([
            'nombre' => 'required|unique:ciclos,nombre,' . $ciclo->id,
            'descripcion' => 'nullable',
        ]);

        $ciclo->update($request->all());
        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo actualizado correctamente.');
    }

    public function destroy(Ciclo $ciclo)
    {
        $ciclo->delete();
        return redirect()->route('admin.ciclos.index')->with('success', 'Ciclo eliminado.');
    }
}
