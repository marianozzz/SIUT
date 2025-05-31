<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permisos = Permission::all();
        return view('admin.permisos.index', compact('permisos'));
    }

    public function create()
    {
        return view('admin.permisos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
        ]);

        Permission::create(['name' => $request->name]);

        return redirect()->route('admin.permisos.index')->with('success', 'Permiso creado correctamente');
    }

    public function edit(Permission $permiso)
    {
        return view('admin.permisos.edit', compact('permiso'));
    }

    public function update(Request $request, Permission $permiso)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permiso->id,
        ]);

        $permiso->update(['name' => $request->name]);

        return redirect()->route('admin.permisos.index')->with('success', 'Permiso actualizado correctamente');
    }

    public function destroy(Permission $permiso)
    {
        $permiso->delete();
        return redirect()->route('admin.permisos.index')->with('success', 'Permiso eliminado correctamente');
    }
}
