<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SubjectPolicy
{
    public function create(User $user, Subject $Subject): bool
    {
        return $user->hasPermissionTo('manage Subjects') && $user->department_id === $Subject->department_id;
    }

    public function view(User $user, Subject $Subject): bool
{
    return $user->hasPermissionTo('manage Subjects') && $user->department_id === $Subject->department_id;
}

public function update(User $user, Subject $Subject): bool
{
    return $user->hasPermissionTo('manage Subjects') && $user->department_id === $Subject->department_id;
}

public function delete(User $user, Subject $Subject): bool
{
    return $user->hasPermissionTo('manage Subjects') && $user->department_id === $Subject->department_id;
}

}
