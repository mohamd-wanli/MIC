<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * السماح للمشرف العام Admin فقط بالتحكم في جميع المستخدمين.
     */
    public function before(User $user)
    {
        if ($user->hasRole('Admin')) {
            return true;
        }
    }

    /**
     * هل المستخدم يستطيع تعديل مستخدم آخر؟
     */
    public function update(User $user, User $targetUser)
    {
        return $user->department_id === $targetUser->department_id;
    }

    /**
     * هل المستخدم يستطيع حذف مستخدم آخر؟
     */
    public function delete(User $user, User $targetUser)
    {
        return $user->department_id === $targetUser->department_id;
    }
}