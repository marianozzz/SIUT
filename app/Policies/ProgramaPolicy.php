<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Programa;

class ProgramaPolicy
{
    public function view(User $user, Programa $programa): bool
    {
        return $user->docente && $user->docente->id === $programa->planificacion->docente_id;
    }

    public function update(User $user, Programa $programa): bool
    {
        return $this->view($user, $programa);
    }

    public function delete(User $user, Programa $programa): bool
    {
        return $this->view($user, $programa);
    }
}
