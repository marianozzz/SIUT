<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumno;

use App\Models\Docente;
use App\Models\Curso;

class AdminController extends Controller
{
    public function index()
{
    $totalEstudiantes = Alumno::count();
    $totalProfesores = Docente::count();
    $totalCursos = Curso::count();

    // Matrículas por mes
    $matriculasPorMes = Alumno::selectRaw('MONTH(created_at) as mes, COUNT(*) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes');

    // Distribución por grado (nivel)
    $distribucionPorGrado = DB::table('alumno_curso')
        ->join('cursos', 'alumno_curso.curso_id', '=', 'cursos.id')
        ->select('cursos.nivel', DB::raw('count(*) as total'))
        ->groupBy('cursos.nivel')
        ->orderBy('cursos.nivel')
        ->pluck('total', 'nivel');

    return view('admin.index', compact(
        'totalEstudiantes',
        'totalProfesores',
        'totalCursos',
        'matriculasPorMes',
        'distribucionPorGrado'
    ));
}

    public function create()
    {
        return view('admin.create');
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
