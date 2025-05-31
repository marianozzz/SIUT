<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaAsignatura;

class CategoriaAsignaturaController extends Controller
{
    public function index()
    {
        $categorias = CategoriaAsignatura::all();
        return view('admin.categoriasasignaturas.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categoriasasignaturas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias_asignaturas,nombre',
        ]);
        CategoriaAsignatura::create($request->only('nombre'));
        return redirect()->route('admin.categoriasasignaturas.index')
                         ->with('success', 'Categoría creada correctamente.');
    }

    public function edit(CategoriaAsignatura $categorias_asignatura)
    {
        return view('admin.categoriasasignaturas.edit', compact('categorias_asignatura'));
    }

    public function update(Request $request, CategoriaAsignatura $categorias_asignatura)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categoriasasignaturas,nombre,' . $categorias_asignatura->id,
        ]);

        $categorias_asignatura->update($request->only('nombre'));

        return redirect()->route('admin.categoriasasignaturas.index')
                         ->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy(CategoriaAsignatura $categorias_asignatura)
    {
        $categorias_asignatura->delete();

        return redirect()->route('admin.categoriasasignaturas.index')
                         ->with('success', 'Categoría eliminada correctamente.');
    }
}
