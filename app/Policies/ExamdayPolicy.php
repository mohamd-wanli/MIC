<?php

namespace App\Policies;

use App\Models\Examday;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ExamdayPolicy
{

    public function create(User $user, Examday $Examday): bool
    {
        return $user->hasPermissionTo('manage Examdays') && $user->department_id === $Examday->department_id;
    }

    public function view(User $user, Examday $Examday): bool
    {
        return $user->hasPermissionTo('manage Examdays') && $user->department_id === $Examday->department_id;
    }
    
    public function update(User $user, Examday $Examday): bool
    {
        return $user->hasPermissionTo('manage Examdays') && $user->department_id === $Examday->department_id;
    }
    
    public function delete(User $user, Examday $Examday): bool
    {
        return $user->hasPermissionTo('manage Examdays') && $user->department_id === $Examday->department_id;
    }
    
}
