<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminsUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Mahmoud',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('123456'),
            'status' => 'active',
        ]);


        // $role = Role::create(['name' => 'owner']);

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);
        $role = Role::find(1);

        $user->assignRole([$role->id]);
    }
}
