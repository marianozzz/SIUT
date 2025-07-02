<?php
namespace App\Policies;

use App\Models\Actividad;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActividadPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Actividad $actividad)
    {
        return $actividad->user_id === $user->id;
    }

    public function update(User $user, Actividad $actividad)
    {
        return $actividad->user_id === $user->id;
    }

    public function delete(User $user, Actividad $actividad)
    {
        return $actividad->user_id === $user->id;
    }

    // Otros métodos si los necesitás...
}
