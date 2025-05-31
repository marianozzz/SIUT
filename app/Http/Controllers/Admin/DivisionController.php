<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    public function index()
    {
        $divisiones = Division::all();
        return view('admin.divisiones.index', compact('divisiones'));
    }

    public function create()
    {
        return view('admin.divisiones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:divisions,nombre',
        ]);

        Division::create([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.divisiones.index')->with('success', 'División creada correctamente.');
    }

    public function edit(Division $division)
    {
        return view('admin.divisiones.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:divisions,nombre,' . $division->id,
        ]);

        $division->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('admin.divisiones.index')->with('success', 'División actualizada correctamente.');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        return redirect()->route('admin.divisiones.index')->with('success', 'División eliminada correctamente.');
    }
}
