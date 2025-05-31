<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AlumnoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AsignaturaController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\PlanificacionController;


use App\Http\Controllers\Docente\CursoController as DocenteCursoController;

Route::middleware(['auth'])->prefix('docente')->name('docente.')->group(function () {
    // Redirigir automáticamente /docente a /docente/dashboard
    Route::redirect('/', '/docente/dashboard');

    // Ruta al dashboard real
    Route::get('/dashboard', [DocenteCursoController::class, 'index'])->name('dashboard');
});


Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('docentes', DocenteController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('admin', AdminController::class);
 

    Route::resource('cursos', CursoController::class);
     Route::get('cursos/{curso}/asignaturas/{asignatura}/asignar-docente', [AsignaturaController::class, 'asignarDocente'])
        ->name('asignaturas.asignar-docente');
    Route::post('cursos/{curso}/asignaturas/{asignatura}/asignar-docente', [AsignaturaController::class, 'guardarDocente'])
        ->name('asignaturas.guardar-docente');
    Route::get('cursos/{curso}/asignar-alumnos', [CursoController::class, 'formAsignarAlumnos'])->name('cursos.asignar-alumnos');
    Route::post('cursos/{curso}/asignar-alumnos', [CursoController::class, 'guardarAlumnos'])->name('cursos.guardar-alumnos');
    Route::post('cursos/{curso}/asignar-asignatura', [CursoController::class, 'asignarAsignatura'])->name('cursos.asignarAsignatura');
    Route::delete('cursos/{curso}/quitar-asignatura/{asignatura}', [CursoController::class, 'quitarAsignatura'])->name('cursos.quitarAsignatura');
   
    Route::resource('divisiones', App\Http\Controllers\Admin\DivisionController::class);
    Route::resource('asignaturas', AsignaturaController::class);
    
    Route::resource('especialidades', EspecialidadController::class)
    ->names('especialidades')
    ->parameters(['especialidades' => 'especialidad']);

    Route::resource('categoriasasignaturas', \App\Http\Controllers\Admin\CategoriaAsignaturaController::class);
    
    Route::resource('planificaciones', PlanificacionController::class)->names('planificaciones');


   // Route::resource('especialidades', EspecialidadController::class)->names('admin.especialidades');
});



//Route::resource('admin', AdminController::class);


//Route::resource('admin/alumnos', AlumnoController::class)->names('admin.alumnos');


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});





require __DIR__.'/auth.php';
