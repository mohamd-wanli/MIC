<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;


class DepartmentScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model)
    {

        $user = request()->user();

        if ($user && $user->department_id) {
            if (!$user->hasRole('Admin')) { // المشرف يمكنه رؤية كل شيء
                $builder->where('department_id', $user->department_id);
                // print_r($user->department_id);exit;
                // echo "sdfsdfsf";
            }
        }
    }

}
