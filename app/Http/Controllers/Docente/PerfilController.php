<?php

namespace App\Http\Controllers\Docentes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('docentes.perfil.index', compact('user'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        return view('docentes.perfil.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
        ]);

        $user->update($request->only('name', 'email'));

        return redirect()->route('docente.perfil.index')->with('success', 'Perfil actualizado correctamente.');
    }
}
