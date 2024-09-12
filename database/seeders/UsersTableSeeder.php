<?php

namespace Database\Seeders;

use App\v1\Models\Permission;
use App\v1\Models\Role;
use App\v1\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $developer = Role::where('slug','web-developer')->first();
        $manager = Role::where('slug', 'project-manager')->first();
        $createTasks = Permission::where('slug','create-tasks')->first();
        $manageUsers = Permission::where('slug','manage-users')->first();

        $faker = Factory::create();
        $password = bcrypt('password');

        $user1 = new User();
        $user1->name = 'Jhon Deo';
        $user1->email = 'jhon@deo.com';
        $user1->password = $password;
        $user1->save();
        $user1->roles()->attach($developer);
        $user1->permissions()->attach($createTasks);

        $user2 = new User();
        $user2->name = 'Mike Thomas';
        $user2->email = 'mike@thomas.com';
        $user2->password = $password;
        $user2->save();
        $user2->roles()->attach($manager);
        $user2->permissions()->attach($manageUsers);
    }
}
