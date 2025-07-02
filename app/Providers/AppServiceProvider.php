<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Importamos los modelos y sus policies
use App\Models\Planificacion;
use App\Policies\PlanificacionPolicy;
use App\Models\Programa;
use App\Policies\ProgramaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     */
    protected $policies = [
        Planificacion::class => PlanificacionPolicy::class,
        Programa::class => ProgramaPolicy::class,
        Actividad::class => ActividadPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
