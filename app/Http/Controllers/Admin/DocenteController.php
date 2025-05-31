<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docente;

class DocenteController extends Controller
{
    
    public function index()
    {
        $docentes = Docente::all();
        return view('admin.docentes.index',compact('docentes'));
    }

    public function create()
    {
        return view('admin.docentes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:docentes,dni',
        ]);

        Docente::create($request->all());

        return redirect()->route('admin.docentes.index')->with('success', 'Docente creado correctamente.');
    }

    public function show(Docente $docente)
    {
        return view('admin.docentes.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        return view('admin.docentes.edit', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'dni' => 'required|unique:docentes,dni,' . $docente->id,
        ]);

        $docente->update($request->all());

        return redirect()->route('admin.docentes.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('admin.docentes.index')->with('success', 'Docente eliminado.');
    }
}
