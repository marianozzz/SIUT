<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;
class AdminController extends Controller
{
     public function index()
    {
       // $admins = User::whereHas('roles', fn ($q) => $q->where('name', 'Admin'))->get();

        // $alumnos = Alumno::all();
       // return view('admin.alumnos.index', compact('alumnos'));
        return view('admin.index');
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        // Validación y creación
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        $user->assignRole('Admin');

        return redirect()->route('admin.admins.index')->with('success', 'Administrador creado.');
    }

    public function show($id)
    {
   
    }

    public function edit($id)
    {
        $admin = User::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $admin->update($request->only('name', 'email'));

        return redirect()->route('admin.admins.index')->with('success', 'Administrador actualizado.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.admins.index')->with('success', 'Administrador eliminado.');
    }
}
