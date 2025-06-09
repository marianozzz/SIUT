<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

// Controladores Admin
use App\Http\Controllers\Admin\AlumnoController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AsignaturaController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\EspecialidadController;
use App\Http\Controllers\Admin\PlanificacionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CategoriaAsignaturaController;
use App\Http\Controllers\Admin\AsignaturaHorarioController;
use App\Http\Controllers\Admin\TurnoController;

// Controlador Dashboard Docente
use App\Http\Controllers\Docente\CursoController as DocenteCursoController;
use App\Http\Controllers\Docente\PerfilController;


// Controlador Dashboard Alumno (crear si no existe)
//use App\Http\Controllers\Alumno\DashboardController as AlumnoDashboardController;

// Página de bienvenida
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard genérico si no hay rol reconocido
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ⚙️ Configuraciones de usuario
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// 👨‍🏫 DOCENTE
Route::prefix('docentes')->name('docentes.')->middleware(['auth', 'role:docente'])->group(function () {
  
    Route::get('/dashboard', function () {return view('/docentes/dashboard');})->name('home');
    Route::resource('/cursos', DocenteCursoController::class);
// Perfil del docente como recurso (si solo usas index, edit, update)
    Route::resource('perfil', PerfilController::class)->only([
        'index', 'edit', 'update'
    ]);

    Route::get('docentes/asignaturas/{id}', [DocenteAsignaturaController::class, 'show'])->name('docentes.asignaturas.show');



});

// 👨‍🎓 ALUMNO (crear controlador o vista según necesites)
/*Route::middleware(['auth', 'role:alumno'])->prefix('alumno')->name('alumno.')->group(function () {
    Route::get('/dashboard', [AlumnoDashboardController::class, 'index'])->name('dashboard');
});*/

// 🛠️ ADMIN
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    
    Route::redirect('/', '/admin/dashboard');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    Route::resource('docentes', DocenteController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('admin', AdminController::class);

    Route::resource('cursos', CursoController::class);
    Route::get('cursos/{curso}/asignaturas/{asignatura}/asignar-docente', [AsignaturaController::class, 'asignarDocente'])
        ->name('asignaturas.asignar-docente');
    Route::post('cursos/{curso}/asignaturas/{asignatura}/asignar-docente', [AsignaturaController::class, 'guardarDocente'])
        ->name('asignaturas.guardar-docente');
    Route::post('cursos/{curso}/asignaturas/{asignaturaCurso}/horarios', [CursoController::class, 'agregarHorario']);
    Route::get('cursos/{curso}/asignar-alumnos', [CursoController::class, 'formAsignarAlumnos'])->name('cursos.asignar-alumnos');
    Route::post('cursos/{curso}/asignar-alumnos', [CursoController::class, 'guardarAlumnos'])->name('cursos.guardar-alumnos');
    Route::post('cursos/{curso}/asignar-asignatura', [CursoController::class, 'asignarAsignatura'])->name('cursos.asignarAsignatura');
    Route::delete('cursos/{curso}/quitar-asignatura/{asignatura}', [CursoController::class, 'quitarAsignatura'])->name('cursos.quitarAsignatura');
  //  Route::resource('admin/cursos/{curso}/asignaturas/{asignaturaCurso}/horarios', AsignaturaHorarioController::class)
  //  ->names('horarios');



   

    Route::resource('divisiones', DivisionController::class);
    Route::resource('asignaturas', AsignaturaController::class);
    Route::resource('especialidades', EspecialidadController::class)
                    ->names('especialidades')
                    ->parameters(['especialidades' => 'especialidad']);

    Route::resource('categoriasasignaturas', CategoriaAsignaturaController::class);
    Route::resource('planificaciones', PlanificacionController::class);

    Route::resource('roles', RoleController::class)->names('roles');
    Route::resource('permisos', PermissionController::class)->names('permisos');
    Route::resource('usuarios', UserController::class);

    Route::resource('turnos', TurnoController::class);

    Route::resource('horarios', AsignaturaHorarioController::class);



});

// (Opcional) Ruta para middleware de redirección por rol
Route::get('/redirect-by-role', function () {
    return 'Redireccionando según tu rol...';
})->middleware(['auth', 'redirect.by.role'])->name('redirect-by-role');

// Rutas de autenticación (Livewire/Breeze/Fortify/etc.)
require __DIR__.'/auth.php';

