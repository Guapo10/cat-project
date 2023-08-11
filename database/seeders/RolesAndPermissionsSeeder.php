<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        Permission::create(['name' => 'create post']);
        Permission::create(['name' => 'edit post']);
        Permission::create(['name' => 'delete post']);

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);
        $userRole = Role::create(['name' => 'user']);

        // Assign permissions to roles
        $adminRole->syncPermissions(['create post', 'edit post', 'delete post']);
        $editorRole->syncPermissions(['create post', 'edit post']);

        // Attach roles to users
        User::factory(10)->create()->each(function ($user) use ($adminRole, $editorRole, $userRole) {
            if ($user->id % 3 === 0) {
                $user->assignRole($adminRole);
            } elseif ($user->id % 2 === 0) {
                $user->assignRole($editorRole);
            } else {
                $user->assignRole($userRole);
            }
        });
    }
}
