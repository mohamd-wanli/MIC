<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    public function create(User $user, Course $Course): bool
    {
        return $user->hasPermissionTo('manage Courses') && $user->department_id === $Course->department_id;
    }

    public function view(User $user, Course $Course): bool
{
    return $user->hasPermissionTo('manage Courses') && $user->department_id === $Course->department_id;
}

public function update(User $user, Course $Course): bool
{
    return $user->hasPermissionTo('manage Courses') && $user->department_id === $Course->department_id;
}

public function delete(User $user, Course $Course): bool
{
    return $user->hasPermissionTo('manage Courses') && $user->department_id === $Course->department_id;
}

}
