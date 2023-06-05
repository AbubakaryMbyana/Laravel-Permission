<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin_role = Role::create(['name' => 'admin']);

        $user_list = Permission::create(['name' => 'users.list']);
        $user_view = Permission::create(['name' => 'users.view']);
        $user_create = Permission::create(['name' => 'users.create']);
        $user_delete = Permission::create(['name' => 'users.delete']);
        $user_update = Permission::create(['name' => 'users.update']);


        $admin_role->givePermissionTo([
            $user_list,
            $user_create,
            $user_view,
            $user_update,
            $user_delete
        ]);

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $admin->assignRole($admin_role);
        $admin->givePermissionTo([
            $user_list,
            $user_create,
            $user_view,
            $user_update,
            $user_delete
        ]);


        $user_role = Role::create(['name' => 'user']);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('password')
        ]);

        $user->assignRole($user_role);
        $user_role->givePermissionTo([
            $user_list,
        ]);

        $user->givePermissionTo([
            $user_list,
        ]);
    }
}
