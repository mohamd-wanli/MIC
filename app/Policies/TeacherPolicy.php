<?php

namespace App\Policies;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{

    public function create(User $user, Teacher $Teacher): bool
    {
        return $user->hasPermissionTo('manage Teachers') && $user->department_id === $Teacher->department_id;
    }
    public function view(User $user, Teacher $Teacher): bool
    {
        return $user->hasPermissionTo('manage Teachers') && $user->department_id === $Teacher->department_id;
    }
    
    public function update(User $user, Teacher $Teacher): bool
    {
        return $user->hasPermissionTo('manage Teachers') && $user->department_id === $Teacher->department_id;
    }
    
    public function delete(User $user, Teacher $Teacher): bool
    {
        return $user->hasPermissionTo('manage Teachers') && $user->department_id === $Teacher->department_id;
    }
    
}
