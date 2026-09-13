<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            'إلكترون', 'فنية', 'حلاقة', 'كمبيوتر', 'حلاقة نسائية',
            'تجميل', 'خياطة', 'إدارة', 'ICDL', 'شهادات'
        ];

        foreach ($departments as $department) {
            Department::firstOrCreate(['name' => $department]);
        }
    
    }
}
