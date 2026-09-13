<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    $admin = User::create([
        'name' => 'Super Admin',
        'email' => 'admin@example.com',
        'password' => bcrypt('123456'),
        'department_id' => null,
        'status' => 'مفعل'
    ]);

    $role = Role::where('name', 'Admin')->first();

    if (!$role) {
        $role = Role::create(['name' => 'Admin']);
    }

    $admin->assignRole($role);
}
}