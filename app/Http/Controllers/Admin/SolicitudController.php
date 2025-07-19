<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\TipoSolicitud;
use App\Models\Alumno;
use App\Models\Docente;
use Illuminate\Support\Facades\Storage;

class SolicitudController extends Controller
{
    public function index()
    {
        $solicitudes = Solicitud::with('tipo', 'alumno', 'docente')->latest()->get();
        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    public function create()
    {
        $tipos = TipoSolicitud::all();
        $alumnos = Alumno::all();
        $docentes = Docente::all();

        return view('admin.solicitudes.create', compact('tipos', 'alumnos', 'docentes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_solicitud_id' => 'required|exists:tipo_solicitudes,id',
            'motivo' => 'required|string',
            'alumno_id' => 'nullable|exists:alumnos,id',
            'docente_id' => 'nullable|exists:docentes,id',
            'archivo' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('archivo')) {
            $validated['archivo'] = $request->file('archivo')->store('solicitudes');
        }

        $validated['estado'] = 'pendiente'; // Por defecto

        Solicitud::create($validated);

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud creada.');
    }

    public function show($id)
    {
        $solicitud = Solicitud::with('tipo', 'alumno', 'docente')->findOrFail($id);
        return view('admin.solicitudes.show', compact('solicitud'));
    }

    public function edit(Solicitud $solicitud)
    {
        $tipos = TipoSolicitud::all();
        $alumnos = Alumno::all();
        $docentes = Docente::all();

        return view('admin.solicitudes.edit', compact('solicitud', 'tipos', 'alumnos', 'docentes'));
    }

    public function update(Request $request, Solicitud $solicitud)
    {
        $validated = $request->validate([
            'tipo_solicitud_id' => 'required|exists:tipo_solicitudes,id',
            'alumno_id' => 'nullable|exists:alumnos,id',
            'docente_id' => 'nullable|exists:docentes,id',
            'motivo' => 'required|string',
            'estado' => 'required|in:pendiente,aprobada,rechazada',
            'respuesta' => 'nullable|string',
            'archivo' => 'nullable|file|max:2048',
        ]);

        if ($request->hasFile('archivo')) {
            if ($solicitud->archivo && Storage::exists($solicitud->archivo)) {
                Storage::delete($solicitud->archivo);
            }
            $validated['archivo'] = $request->file('archivo')->store('solicitudes');
        }

        $solicitud->update($validated);

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
    }

    public function destroy(Solicitud $solicitud)
    {
        if ($solicitud->archivo && Storage::exists($solicitud->archivo)) {
            Storage::delete($solicitud->archivo);
        }

        $solicitud->delete();

        return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud eliminada.');
    }
}
