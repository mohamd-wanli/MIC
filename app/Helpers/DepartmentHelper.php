<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentHelper
{
    public static function filterByDepartment($query, $table)
    {
        $user = request()->user(); // الحصول على المستخدم الحالي
    
        if ($user && $user->department_id) {
            if (!$user->hasRole('Admin')) {
                return DB::table($table)->where('department_id', $user->department_id);
            }
        }
        
        return DB::table($table);
    }
    
}