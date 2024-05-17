<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    private $permissions = [
        'view posts',
        'create posts',
        'edit posts',
        'delete posts'
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Post::factory(10)->create();

        $adminAccount = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin')
        ]);

        // get each item in permissions array and create permissions
        foreach($this->permissions as $p){
            Permission::create(['name' => $p]);
        }

        // creating and assigning permission of admin role
        $admin = Role::create(['name' => 'admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $admin->syncPermissions($permissions);
        $adminAccount->assignRole([$admin->id]);

        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo(
            'view posts',
            'create posts'
        );
    }
}
