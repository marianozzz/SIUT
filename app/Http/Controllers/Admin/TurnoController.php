<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;

class TurnoController extends Controller
{
    public function index()
    {
        $turnos = Turno::all();
        return view('admin.turnos.index', compact('turnos'));
    }

    public function create()
    {
        return view('admin.turnos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:turnos,nombre',
        ]);

        Turno::create($request->only('nombre'));

        return redirect()->route('admin.turnos.index')->with('success', 'Turno creado correctamente.');
    }

    public function edit(Turno $turno)
    {
        return view('admin.turnos.edit', compact('turno'));
    }

    public function update(Request $request, Turno $turno)
    {
        $request->validate([
            'nombre' => 'required|string|unique:turnos,nombre,' . $turno->id,
        ]);

        $turno->update($request->only('nombre'));

        return redirect()->route('admin.turnos.index')->with('success', 'Turno actualizado correctamente.');
    }

    public function destroy(Turno $turno)
    {
        $turno->delete();
        return redirect()->route('admin.turnos.index')->with('success', 'Turno eliminado.');
    }
}
