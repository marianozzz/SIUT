<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Curso;
use App\Models\Division;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AlumnoImportExportController extends Controller
{
    public function export()
    {
        $alumnos = Alumno::with('cursos.division')->get();

        $response = new StreamedResponse(function () use ($alumnos) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Nombre', 'Apellido', 'DNI', 'Email', 'Teléfono', 'Curso', 'División']);

            foreach ($alumnos as $alumno) {
                $curso = $alumno->cursos->last(); // último curso asignado (puede ser null)
                fputcsv($handle, [
                    $alumno->nombre,
                    $alumno->apellido,
                    $alumno->dni,
                    $alumno->email,
                    $alumno->telefono,
                    $curso?->nivel ?? '',
                    $curso?->division->nombre ?? '',
                ]);
            }

            fclose($handle);
        });

        // Forzar descarga
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="alumnos.csv"');

        return $response;
    }

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:csv,txt'
    ]);

    $file = $request->file('file');
    $handle = fopen($file, 'r');
    fgetcsv($handle); // Saltar encabezado

    while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        if (empty($data[0]) || empty($data[1]) || empty($data[2])) {
            continue; // saltar filas sin nombre, apellido o dni
        }

        Alumno::updateOrCreate(
            ['dni' => $data[2]],
            [
                'nombre' => $data[0],
                'apellido' => $data[1],
                'email' => $data[3] ?? null,
                'telefono' => $data[4] ?? null,
                'curso_id' => $data[5] ?? null,
            ]
        );
    }

    fclose($handle);

    return redirect()->route('admin.alumnos.index')->with('success', 'Alumnos importados correctamente.');
}

}
