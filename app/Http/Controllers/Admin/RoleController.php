<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        $permisos = Permission::all();
        return view('admin.roles.create', compact('permisos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array'
        ]);

        $role = Role::create(['name' => $request->name]);
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente');
    }

    public function edit(Role $rol)
    {
        $permisos = Permission::all();
        return view('admin.roles.edit', compact('rol', 'permisos'));
    }

    public function update(Request $request, Role $rol)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $rol->id,
            'permissions' => 'array'
        ]);

        $rol->update(['name' => $request->name]);
        $rol->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(Role $rol)
    {
        $rol->delete();
        return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamente');
    }
}
