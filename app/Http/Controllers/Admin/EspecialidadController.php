<?php

// app/Http/Controllers/Admin/EspecialidadController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        $especialidades = Especialidad::all();
        return view('admin.especialidades.index', compact('especialidades'));
    }

    public function create()
    {
        return view('admin.especialidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre',
            'descripcion' => 'nullable|string',
        ]);

        Especialidad::create($request->all());

        return redirect()->route('admin.especialidades.index')
            ->with('success', 'Especialidad creada correctamente.');
    }

    public function show(Especialidad $especialidad)
    {
        return view('admin.especialidades.show', compact('especialidad'));
    }

    public function edit(Especialidad $especialidad)
    {
        return view('admin.especialidades.edit', compact('especialidad'));
    }

    public function update(Request $request, Especialidad $especialidad)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:especialidades,nombre,' . $especialidad->id,
            'descripcion' => 'nullable|string',
        ]);

        $especialidad->update($request->all());

        return redirect()->route('admin.especialidades.index')
            ->with('success', 'Especialidad actualizada correctamente.');
    }

    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();

        return redirect()->route('admin.especialidades.index')
            ->with('success', 'Especialidad eliminada correctamente.');
    }
}
