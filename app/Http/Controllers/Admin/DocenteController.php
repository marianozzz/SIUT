<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            /**Falta que asigne rol docente por defecto */
            $request->validate([
            'email' => 'required|email',
            'name' => 'required|string',
            'password' => 'nullable|string|min:6',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'dni' => 'required|string|unique:docentes,dni',
            'telefono' => 'nullable|string',
            'direccion' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {
            // Buscar usuario existente por email
            $usuario = User::where('email', $request->email)->first();

            if (!$usuario) {
                // Si no existe, lo creamos
                $usuario = User::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'password' => Hash::make($request->password ?? 'password123'),
                ]);
            }

            // Verificar que no tenga un docente ya asignado
            if ($usuario->docente) {
                return back()->withErrors(['email' => 'Este usuario ya tiene un docente asociado.'])->withInput();
            }

            // Crear el docente
            $docente = new Docente();
            $docente->usuario_id = $usuario->id;
            $docente->nombre = $request->nombre;
            $docente->apellido = $request->apellido;
            $docente->dni = $request->dni;
            $docente->telefono = $request->telefono;
            $docente->direccion = $request->direccion;
            $docente->save();

            DB::commit();

            return redirect()->route('admin.docentes.index')->with('success', 'Docente creado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Error al crear docente: ' . $e->getMessage()])->withInput();
        }
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
