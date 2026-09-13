<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Role;

class DepartmentRoleSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            'إلكترون' => 'إلكترون',
            'فنية' => 'فنية',
            'حلاقة' => 'حلاقة',
            'كمبيوتر' => 'كمبيوتر',
            'حلاقة نسائية' => 'حلاقة نسائية',
            'تجميل' => 'تجميل',
            'خياطة' => 'خياطة',
            'ICDL' => 'ICDL',
            'شهادات' => 'شهادات',
            'إدارة' => 'إدارة',
        ];

        foreach ($departments as $departmentName => $roleName) {
            $department = Department::firstOrCreate(['name' => $departmentName]);
            $role = Role::where('name', $roleName)->first();

            if ($role) {
                $department->roles()->syncWithoutDetaching([$role->id]);
            }
        }
    }
}
