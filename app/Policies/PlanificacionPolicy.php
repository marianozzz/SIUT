<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Planificacion;

class PlanificacionPolicy
{
    public function view(User $user, Planificacion $planificacion): bool
    {
        return $user->docente && $user->docente->id === $planificacion->docente_id;
    }

    public function update(User $user, Planificacion $planificacion): bool
    {
        return $this->view($user, $planificacion);
    }

    public function delete(User $user, Planificacion $planificacion): bool
    {
        return $this->view($user, $planificacion);
    }
}
